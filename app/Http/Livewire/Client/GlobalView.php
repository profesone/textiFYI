<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\TextResponse;
use App\Models\Keyword;
use App\Models\User;
use Laravel\Prompts\Key;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GlobalView extends Component
{
    public Client $client;
    public $responses;
    public $edited;
    public $newKeyword;
    public $editedRowIndex = null;
    public $editedRowField = null;
    public $start_date = null;
    public $end_date = null;
    private $teamId = null;

    public function mount(Client $client)
    {
        $this->client = $client;
        // Set Client's team if not set previously
        if (auth()->user()->team_id){
            User::where('id', $this->client->id)
                ->update(['team_id' => auth()->user()->team_id]);
        }
        $this->edited = '';
        $this->newKeyword = '';
        $this->responses = TextResponse::where('client_id', $this->client->id)
            ->where('team_id', $this->teamId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.client.global_view');
    }

    public function submit()
    {
        $this->validate();
        $this->client->save();

        return redirect()->route('admin.clients.show');
    }

    public function editedRowField($rowIndex, $fieldName)
    {
        $this->newKeyword = '';
        $this->editedRowField = $fieldName;
        $this->editedRowIndex = $rowIndex;

        return true;
    }

    public function saveField(int $index)
    {
        $name = $this->editedRowField;
        $key  = $this->editedRowIndex;

        if(!is_int($key)) {
            return;
        }

        TextResponse::where("id", $key)
            ->where($name, $this->responses[$index][$name])
            ->update([$name => $this->edited]);

        $this->clearView();
    }

    public function addKeyword(string $keyword, int $responseId)
    {
        $keywordId = $this->ifKeywordExist($keyword);
        // Add record to keyword_text_response
        DB::table('keyword_text_response')
            ->updateOrInsert(['text_response_id' => $responseId, 'keyword_id' => $keywordId], ['keyword_id' => $keywordId]);
        $this->editedRowField = 'keyword';
        // Add to the list of keywords

        // Clear input box
        $this->newKeyword = '';
    }

    public function addMainKeyword(string $keyword, int $responseId)
    {
        $keywordId = $this->ifKeywordExist($keyword);
        TextResponse::where('id', $responseId)->update(['main_keyword_id' => $keywordId]);

        $this->clearView();
    }

    private function ifKeywordExist(string $keyword) : int
    {
        $keyword = strtolower($keyword);
        // If the keyword exist use it
        $keywordId = Keyword::where('keyword', $keyword)->pluck('id')[0] ?? false;
        if ($keywordId === false) {
            // Create new keyword if it doesn't already exist
            $keywordId = Keyword::insertGetId(['keyword' => $keyword]);
        }

        return $keywordId;
    }

    public function removeKeyword(int $responseId, int $keywordId)
    {
        DB::table('keyword_text_response')
            ->where('text_response_id', $responseId)
            ->where('keyword_id', $keywordId)
            ->delete();

        $this->clearView();
    }

    public function editKeyword(int $keywordId, $keyword, $responseId)
    {
        $this->removeKeyword($responseId, $keywordId);
        $keyword = strtolower($keyword);

        // If the keyword exist use it
        $id = Keyword::where('keyword', $keyword)->pluck('id');
        if (!$id) {
            // Add new keyword if it doesn't exist
            $id = Keyword::insertGetId(['keyword' => $keyword]);
        }
        // Add record
        DB::table('keyword_text_response')
            ->insert(['text_response_id' => $responseId, 'keyword_id' => $id]);
    }

    public function deleteResponse($textResponseId)
    {
        // Delete the entire response
        TextResponse::where('id', $textResponseId)->delete();

        // Delete all keywords associated
        DB::table('keyword_text_response')->where('text_response_id', $textResponseId)->delete();

        $this->clearView();
    }

    public function createResponse()
    {
        // Delete the entire response
        TextResponse::insert([
            'client_id' => $this->client->id,
            'created_at' => now()->subMonth()
        ]);
        $this->clearView();
    }

    public function updateSchedule($responseId)
    {
        if(empty($this->start_date) || empty($this->end_date)){
            return false;
        }

        TextResponse::where('id', $responseId)->update(
            ['start_date' => $this->start_date, 'end_date' => $this->end_date]
        );

        $this->clearView();
    }

    private function clearView()
    {
        $this->editedRowField = null;
        $this->editedRowIndex = null;
        $this->edited         = null;
        $this->newKeyword     = null;
        $this->start_date     = null;
        $this->end_date       = null;
        $this->responses = TextResponse::where('client_id', $this->client->id)
            ->where('team_id', $this->teamId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
