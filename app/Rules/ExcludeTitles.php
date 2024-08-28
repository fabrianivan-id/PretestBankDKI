<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExcludeTitles implements Rule
{
    protected $forbiddenWords = [
        'Hj.','H.','profesor', 'haji', 'hajjah', 'drg', 'drg.', 'dr', 'dr.', 'prof', 'prof.', 's.kom', 's.kom.', 's.t', 's.t.', 'm.t', 'm.t.', 'sarjana'
        // Tambahkan kata-kata lainnya yang ingin Anda larang
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nama tidak boleh mengandung gelar atau kata-kata terlarang seperti Profesor, Haji, S.Kom, dll.';
    }
}
