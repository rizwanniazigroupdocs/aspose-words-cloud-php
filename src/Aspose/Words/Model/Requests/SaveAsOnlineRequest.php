<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="SaveAsOnlineRequest.php">
 *   Copyright (c) 2020 Aspose.Words for Cloud
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------
 */

namespace Aspose\Words\Model\Requests;

/*
 * Request model for saveAsOnline operation.
 */
class SaveAsOnlineRequest
{
    /*
     * The document.
     */
    public $document;

    /*
     * Save options.
     */
    public $save_options_data;

    /*
     * Folder in filestorage with custom fonts.
     */
    public $fonts_location;

    /*
     * Initializes a new instance of the SaveAsOnlineRequest class.
     *
     * @param \SplFileObject $document The document.
     * @param \Aspose\Words\Model\SaveOptionsData $save_options_data Save options.
     * @param string $fonts_location Folder in filestorage with custom fonts.
     */
    public function __construct($document, $save_options_data, $fonts_location = null)
    {
        $this->document = $document;
        $this->save_options_data = $save_options_data;
        $this->fonts_location = $fonts_location;
    }

    /*
     * The document.
     */
    public function get_document()
    {
        return $this->document;
    }

    /*
     * The document.
     */
    public function set_document($value)
    {
        $this->document = $value;
        return $this;
    }

    /*
     * Save options.
     */
    public function get_save_options_data()
    {
        return $this->save_options_data;
    }

    /*
     * Save options.
     */
    public function set_save_options_data($value)
    {
        $this->save_options_data = $value;
        return $this;
    }

    /*
     * Folder in filestorage with custom fonts.
     */
    public function get_fonts_location()
    {
        return $this->fonts_location;
    }

    /*
     * Folder in filestorage with custom fonts.
     */
    public function set_fonts_location($value)
    {
        $this->fonts_location = $value;
        return $this;
    }
}
