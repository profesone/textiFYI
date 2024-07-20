<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'locale'                   => 'Locale',
            'locale_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'team' => [
        'title'          => 'Agencies',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Event',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Attributes',
            'properties_helper'   => ' ',
            'host'                => 'IP',
            'host_helper'         => ' ',
            'created_at'          => 'Event time',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'textifyiNumber' => [
        'title'          => 'Textifyi Numbers',
        'title_singular' => 'Textifyi Number',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'textifyi_numbers'        => 'TextiFYI Numbers',
            'textifyi_numbers_helper' => 'TextiFYI provided numbers.',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'team'                    => 'Team',
            'team_helper'             => ' ',
            'used'                    => 'Used',
            'used_helper'             => ' ',
        ],
    ],
    'client' => [
        'title'          => 'Clients',
        'title_singular' => 'Clients',
        'fields'         => [
            'id'                                  => 'ID',
            'id_helper'                           => ' ',
            'client_name'                         => 'Client Name',
            'client_name_helper'                  => ' ',
            'company_name'                        => 'Company Name',
            'company_name_helper'                 => ' ',
            'main_contact_number'                 => 'Main Contact Number',
            'main_contact_number_helper'          => ' ',
            'email'                               => 'Email',
            'email_helper'                        => ' ',
            'texti_fyi_number'                    => 'TextiFYI Number',
            'texti_fyi_number_helper'             => ' ',
            'default_message'                     => 'Default Message',
            'default_message_helper'              => ' ',
            'default_request_message'             => 'Default Request Message',
            'default_request_message_helper'      => ' ',
            'default_zipcode_message'             => 'Default Zipcode Message',
            'default_zipcode_message_helper'      => ' ',
            'email_address_response'              => 'Email Address Response',
            'email_address_response_helper'       => ' ',
            'default_messages_module'             => 'Default Messages Module',
            'default_messages_module_helper'      => ' ',
            'default_message_notification'        => 'Default Message Notification',
            'default_message_notification_helper' => ' ',
            'default_message_response'            => 'Default Message Response',
            'default_message_response_helper'     => ' ',
            'publish_keywords_module'             => 'Publish Keywords Module',
            'publish_keywords_module_helper'      => ' ',
            'leads_module'                        => 'Leads Module',
            'leads_module_helper'                 => ' ',
            'keyword_module'                      => 'Keyword Module',
            'keyword_module_helper'               => ' ',
            'mls_listing_module'                  => 'Mls Listing Module',
            'mls_listing_module_helper'           => ' ',
            'mls_agent_notification'              => 'Mls Agent Notification',
            'mls_agent_notification_helper'       => ' ',
            'tips_request_module'                 => 'Tips/Request Module',
            'tips_request_module_helper'          => ' ',
            'zip_code_module'                     => 'Zip Code Module',
            'zip_code_module_helper'              => ' ',
            'default_zip_notification'            => 'Default Zip Notification',
            'default_zip_notification_helper'     => ' ',
            'email_address_module'                => 'Email Address Module (@ Module)',
            'email_address_module_helper'         => ' ',
            'default_email_notification'          => 'Default Email Notification',
            'default_email_notification_helper'   => ' ',
            'created_at'                          => 'Created at',
            'created_at_helper'                   => ' ',
            'updated_at'                          => 'Updated at',
            'updated_at_helper'                   => ' ',
            'deleted_at'                          => 'Deleted at',
            'deleted_at_helper'                   => ' ',
            'team'                                => 'Team',
            'team_helper'                         => ' ',
        ],
    ],
    'keyword' => [
        'title'          => 'Keywords',
        'title_singular' => 'Keyword',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'keyword'           => 'Keyword',
            'keyword_helper'    => ' ',
            'client'            => 'Client',
            'client_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'textResponse' => [
        'title'          => 'Text Responses',
        'title_singular' => 'Text Response',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'notes'                    => 'Notes',
            'notes_helper'             => 'Any helpful notes you would like to leave.',
            'notification_main'        => 'Notification Main',
            'notification_main_helper' => ' ',
            'start_date'               => 'Start Date',
            'start_date_helper'        => ' ',
            'end_date'                 => 'End Date',
            'end_date_helper'          => ' ',
            'active'                   => 'Active',
            'active_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
            'response'                 => 'Response',
            'response_helper'          => ' ',
            'client'                   => 'Client',
            'client_helper'            => ' ',
            'campaign'                 => 'Campaign',
            'campaign_helper'          => 'A title to help categorize the response.',
            'keywords'                 => 'Keywords',
            'keywords_helper'          => ' ',
            'notification_01'          => 'Notification 01',
            'notification_01_helper'   => ' ',
            'main_keyword'             => 'Main Keyword',
            'main_keyword_helper'      => ' ',
        ],
    ],

];
