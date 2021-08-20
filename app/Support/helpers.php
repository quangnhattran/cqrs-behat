<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

if (!function_exists('generateApiToken')) {
    /**
     * Get current locale
     *
     * @param int|null $length
     * @return string
     */
	function generateApiToken(int $length = null): string
    {
        return Str::random($length ?? config('constants.api_token_length'));
	}
}

if (!function_exists('checkPassword')) {
	/**
	 * Check plain and hashed password
	 *
	 * @param string $plainPassword
	 * @param string $hashedPassword
	 * @return boolean
	 */
	function checkPassword(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
	}
}
