<?php
return [
    "title_page_list"=> "Admin account management",
    "title_page_create"=> "Create Account Admin",
    "title_page_edit"=> "Account Infomation",
    "button_create"=> "Sign Up",
    "form_filter"=> [
        "placeholder_input_keyword"=> "Please enter a keyword",
        "select_all_roles"=> "All role",
        "select_roles"=> "Role",
        "input_text_search"=> "Keyword",
        "button_clear"=> "Clear",
        "button_search"=> "Search"
    ],
    "table"=> [
        "name"=> "Name",
        "email"=> "Email",
        "role"=> "Role",
        "note"=> "Note",
        "last_login"=> "Last Login",
        "action"=> "Action",
        "action_edit"=> "Edit",
        "action_delete"=> "Remove"
    ],
    "form_create"=> [
        "title"=> "Account Info",
        "input_name"=> "Name",
        "input_email"=> "Email",
        "role"=> "Role",
        "note"=> "Note",
        "button_create"=> "Register",
        "button_edit"=> "Save",
        "button_remove"=> "Remove account",
        "alert_create_success" => 'create admin success',
        "alert_edit_success" => 'update admin success',
        "alert_error" => 'Some error occured! Please try again'
    ],
    "confirm_remove"=> [
        "title_remove"=> "Are you sure？",
        "content"=> "If you delete your account, all information such as email address and application data will be deleted.",
        "button_cancel"=> "Cancel",
        "button_success"=> "Delete account"
    ],
    "validator"  => [
        "name_required" => 'name is required',
        "name_maxLength" => 'name cannot exceed 255 characters',
        'email_required' => 'email is required',
        'email_valid' => 'incorrect email format',
        'email_maxLength' => 'email cannot exceed 255 characters',
        "note_maxLength" => 'note cannot exceed 500 characters',
    ],
];
?>