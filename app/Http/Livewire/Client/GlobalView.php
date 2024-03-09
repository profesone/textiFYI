<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\TextResponse;
use App\Models\Keyword;
use Laravel\Prompts\Key;
use Livewire\Component;

class GlobalView extends Component
{
    public Client $client;
    public $responses = [];
    public $edited;
    public $editedKeyword;
    public $editedRowIndex = null;
    public $editedRowField = null;

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->edited = '';
        $this->editedKeyword = '';
        $this->responses = TextResponse::where('client_id', $this->client->id)->get();
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

        $this->editedRowField = null;
        $this->editedRowIndex = null;
        $this->edited         = null;
        $this->responses = TextResponse::where('client_id', $this->client->id)->get();
    }

    public function addKeyword(string $keyword, int $responseId)
    {
        $keyword = strtolower($keyword);
        // If the keyword exist use it
        $keywordId = Keyword::where('keyword', $keyword)->pluck('id');
        if (!$keywordId) {
            // Add new keyword if it doesn't exist
            $keywordId = Keyword::insertGetId(['keyword' => $keyword]);
        }
        // Add record
        DB::table('keyword_text_response')
            ->insert(['text_response_id' => $responseId, 'keyword_id' => $keywordId]);
    }

    public function removeKeyword(int $responseId, int $keywordId)
    {
        DB::table('keyword_text_response')
            ->where('response_id', $responseId)
            ->where('keyword_id', $keywordId)
            ->delete();
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
}
