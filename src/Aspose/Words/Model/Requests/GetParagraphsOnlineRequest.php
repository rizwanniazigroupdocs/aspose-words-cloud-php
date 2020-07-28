<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="GetParagraphsOnlineRequest.php">
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
 * Request model for getParagraphsOnline operation.
 */
class GetParagraphsOnlineRequest
{
    /*
     * Path to the node which contains paragraphs.
     */
    public $node_path;

    /*
     * The document.
     */
    public $document;

    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public $load_encoding;

    /*
     * Password for opening an encrypted document.
     */
    public $password;

    /*
     * Initializes a new instance of the GetParagraphsOnlineRequest class.
     *
     * @param string $node_path Path to the node which contains paragraphs.
     * @param \SplFileObject $document The document.
     * @param string $load_encoding Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     * @param string $password Password for opening an encrypted document.
     */
    public function __construct($node_path, $document, $load_encoding = null, $password = null)
    {
        $this->node_path = $node_path;
        $this->document = $document;
        $this->load_encoding = $load_encoding;
        $this->password = $password;
    }

    /*
     * Path to the node which contains paragraphs.
     */
    public function get_node_path()
    {
        return $this->node_path;
    }

    /*
     * Path to the node which contains paragraphs.
     */
    public function set_node_path($value)
    {
        $this->node_path = $value;
        return $this;
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
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public function get_load_encoding()
    {
        return $this->load_encoding;
    }

    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public function set_load_encoding($value)
    {
        $this->load_encoding = $value;
        return $this;
    }

    /*
     * Password for opening an encrypted document.
     */
    public function get_password()
    {
        return $this->password;
    }

    /*
     * Password for opening an encrypted document.
     */
    public function set_password($value)
    {
        $this->password = $value;
        return $this;
    }
}
