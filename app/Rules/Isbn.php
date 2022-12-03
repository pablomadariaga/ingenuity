<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Isbn implements Rule
{
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
        $valueExplode = explode('-', $value);
        $passes = true;
        if (count($valueExplode) != 5) {
            $passes = false;
        } else {
            foreach ($valueExplode as $key => $split) {
                if (!is_numeric($split)) {
                    $passes = false;
                    break;
                }
                if (!$this->checkSplit($split, $key)) {
                    $passes = false;
                    break;
                }
            }
        }
        return $passes;
    }

    /**
     * Check if split is correct length
     *
     * @param mixed $split
     * @param integer $key
     * @return boolean
     */
    public function checkSplit(mixed $split, int $key): bool
    {
        $splitLength = str($split)->length();
        $passes = false;
        switch ($key) {
            case 0||1:
                $passes = $splitLength == 3;
                break;
            case 2:
                $passes = $splitLength == 4;
                break;
            case 3:
                $passes = $splitLength == 2;
                break;
            default:
                $passes = $splitLength == 1;
                break;
        }
        return $passes;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.isbn');
    }
}
