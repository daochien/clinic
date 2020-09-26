<?php
namespace App\Models;

use App\Models\User;
use App\Models\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class Submission extends Model
{
	/**
	 * The table name
	 *
	 * @var string
	 */
	protected $table = 'form_submissions';

    /**
     * The attributes that are not assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be casted to another data type
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
    ];

    /**
     * A Submission may belong to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function requestLogs()
    {
        return $this->hasMany(RequestLog::class, 'request_id', 'id')->orderByDesc('created_at');
    }

    public function requestComments()
    {
        return $this->hasMany(RequestComment::class, 'request_id', 'id');
    }

    public function approvers()
    {
        return $this->belongsToMany(User::class, 'template_approvers', 'form_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'template_category', 'form_id', 'category_id');
    }
    /**
     * Get the forms that belong to the provided user
     *
     * @param User $user
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getForUser($user)
    {
        return static::where('user_id', $user->id)->with('form')->latest()->paginate(100);
    }

    /**
     * Load the values the user provided in this submission into the json of the form
     * so that when we render the form, the user's previous values are pre-filled
     *
     * @return void
     */
    public function loadSubmissionIntoFormJson() : void
    {
        $submission_content = $this->content;

        $n = collect($this->form->form_builder_array)
                ->map(function ($entry) use ($submission_content) {
                    if (
                        ! empty($entry['name']) &&
                        array_key_exists($entry['name'], $submission_content)
                    ) {
                        // the field has a 'name' which means it is not a header or paragraph
                        // and the user previously have an entry for that field in the $submission_content
                        $current_submitted_val = $submission_content[$entry['name']] ?? '';

                        if ((empty($entry['value']) && empty($entry['values']))) {
                            // for input types that do not get their values from a 'values' array
                            // set the staight 'value' string and move on
                            $entry['value'] = $current_submitted_val;
                        } else if (! empty($entry['values'])) {
                            // this will hold what will think is the value of the 'other' input
                            // in a checkbox-group that allows the 'other' option
                            $otherInputVal = null;

                            // manipulate the values array so we can preselect the entries that
                            // were chosen in the submission we have on file.
                            if (is_array($current_submitted_val)) {
                                $entry['values'] = collect($entry['values'])
                                                    ->map(function ($v) use ($current_submitted_val) {
                                                        // if this value in the 'values' array is in the
                                                        // previous selection made by the user in their
                                                        // submission, we will add the selected and checked
                                                        // flag to the value so that it will be pre-selected
                                                        // when we render the form
                                                        if (in_array($v['value'], $current_submitted_val)) {
                                                            $v['selected'] = true;
                                                            $v['checked'] = 'checked';
                                                        }

                                                        return $v;
                                                    })
                                                    ->toArray();
                            }

                            // check if the 'other' input option is available
                            if (! empty($entry['other']) && $entry['other'] === true) {
                                // let's attempt to get the value that was provided via the
                                // 'other' input field of a checkbox-group
                                // get the submitted value that is not part of the 'values'
                                // array for this entry
                                $values_names = collect($entry['values'])
                                            ->map(function ($v) {
                                                return $v['value'];
                                            })
                                            ->toArray();

                                $other = collect($current_submitted_val)
                                            ->filter(function ($sv) use ($values_names) {
                                                return ! in_array($sv, $values_names);
                                            })
                                            ->values();

                                $otherInputVal = $other[0] ?? null;
                            }

                            // still set the value on the entry as we have it
                            $entry['value'] = $otherInputVal ?? $current_submitted_val;
                        }
                    }

                    return $entry;
                });

        $this->form->form_builder_json = $n;
    }

    /**
     * Turn the current value we are trying to display to string we can actually display
     *
     * @param string $key
     * @param string $type the type of the input type that this key belongs to on the form
     * @param boolean $limit_string
     * @return Illuminate\Support\HtmlString
     */
    public function renderEntryContent($key, $type = null, $limit_string = false) : HtmlString
    {
        $str = '';

        if(
            ! empty($this->content[$key]) &&
            is_array($this->content[$key])
        ) {
            $str = implode(', ', $this->content[$key]);
        } else {
            $str = $this->content[$key] ?? '';
        }

        if ($limit_string) {
            $str = \Illuminate\Support\Str::limit($str, 20);
        }

        // if the type is 'file' then we have to render this as a link
        if ($type == 'file') {
		if(isset($this->content[$key])){
			$file_link = Storage::url($this->content[$key]);
			$str = "<a href='{$file_link}'>{$str}</a>";
	    	} else {
			$str = "No file";
	    	}
        }

        return new HtmlString($str);
    }
}
