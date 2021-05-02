<?php
/**
 * This is a PHP library that handles calling reCAPTCHA.
 *
 * @copyright Copyright (c) 2015, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace ReCaptcha;

class ResponseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provideJson
     */
    public function testFromJson($json, $success, $errorCodes, $hostname)
    {
        $response = Response::fromJson($json);
        $this->assertEquals($success, $response->isSuccess());
        $this->assertEquals($errorCodes, $response->getErrorCodes());
        $this->assertEquals($hostname, $response->getHostname());
    }

    public function provideJson()
    {
        return [
            ['{"success": true}', true, [], null],
            ['{"success": true, "hostname": "google.com"}', true, [], 'google.com'],
            ['{"success": false, "error-codes": ["test"]}', false, ['test'], null],
            ['{"success": false, "error-codes": ["test"], "hostname": "google.com"}', false, ['test'], 'google.com'],
            ['{"success": true, "error-codes": ["test"]}', true, [], null],
            ['{"success": true, "error-codes": ["test"], "hostname": "google.com"}', true, [], 'google.com'],
            ['{"success": false}', false, [], null],
            ['{"success": false, "hostname": "google.com"}', false, [], 'google.com'],
            ['BAD JSON', false, ['invalid-json'], null],
        ];
    }

    public function testIsSuccess()
    {
        $response = new Response(true);
        $this->assertTrue($response->isSuccess());

        $response = new Response(false);
        $this->assertFalse($response->isSuccess());

        $response = new Response(true, [], 'example.com');
        $this->assertEquals('example.com', $response->getHostName());
    }

    public function testGetErrorCodes()
    {
        $errorCodes = ['test'];
        $response = new Response(true, $errorCodes);
        $this->assertEquals($errorCodes, $response->getErrorCodes());
    }

    public function testGetHostname()
    {
        $hostname = 'google.com';
        $errorCodes = [];
        $response = new Response(true, $errorCodes, $hostname);
        $this->assertEquals($hostname, $response->getHostname());
    }
}
