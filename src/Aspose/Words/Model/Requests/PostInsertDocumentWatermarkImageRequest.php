<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="PostInsertDocumentWatermarkImageRequest.php">
 *   Copyright (c) 2018 Aspose.Words for Cloud
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
 * --------------------------------------------------------------------------------------------------------------------
 */

namespace Aspose\Words\Model\Requests;

/*
 * Request model for postInsertDocumentWatermarkImage operation.
 */
class PostInsertDocumentWatermarkImageRequest
{
    /*
     * The document name.
     */
    public $name;
	
    /*
     * File with image
     */
    public $image_file;
	
    /*
     * Original document folder.
     */
    public $folder;
	
    /*
     * File storage, which have to be used.
     */
    public $storage;
	
    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public $load_encoding;
	
    /*
     * Password for opening an encrypted document.
     */
    public $password;
	
    /*
     * Result name of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public $dest_file_name;
	
    /*
     * Initials of the author to use for revisions.If you set this parameter and then make some changes to the document programmatically, save the document and later open the document in MS Word you will see these changes as revisions.
     */
    public $revision_author;
	
    /*
     * The date and time to use for revisions.
     */
    public $revision_date_time;
	
    /*
     * The watermark rotation angle.
     */
    public $rotation_angle;
	
    /*
     * The image file server full name. If the name is empty the image is expected in request content.
     */
    public $image;
    
	
    /*
     * Initializes a new instance of the PostInsertDocumentWatermarkImageRequest class.
     *  
     * @param string $name The document name.
     * @param \SplFileObject $image_file File with image
     * @param string $folder Original document folder.
     * @param string $storage File storage, which have to be used.
     * @param string $load_encoding Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     * @param string $password Password for opening an encrypted document.
     * @param string $dest_file_name Result name of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     * @param string $revision_author Initials of the author to use for revisions.If you set this parameter and then make some changes to the document programmatically, save the document and later open the document in MS Word you will see these changes as revisions.
     * @param string $revision_date_time The date and time to use for revisions.
     * @param double $rotation_angle The watermark rotation angle.
     * @param string $image The image file server full name. If the name is empty the image is expected in request content.
     */
    public function __construct($name, $image_file = null, $folder = null, $storage = null, $load_encoding = null, $password = null, $dest_file_name = null, $revision_author = null, $revision_date_time = null, $rotation_angle = null, $image = null)             
    {
        $this->name = $name;
        $this->image_file = $image_file;
        $this->folder = $folder;
        $this->storage = $storage;
        $this->load_encoding = $load_encoding;
        $this->password = $password;
        $this->dest_file_name = $dest_file_name;
        $this->revision_author = $revision_author;
        $this->revision_date_time = $revision_date_time;
        $this->rotation_angle = $rotation_angle;
        $this->image = $image;
    }

    /*
     * The document name.
     */
    public function get_name()
    {
        return $this->name;
    }

    /*
     * The document name.
     */
    public function set_name($value)
    {
        $this->name = $value;
        return $this;
    }
	
    /*
     * File with image
     */
    public function get_image_file()
    {
        return $this->image_file;
    }

    /*
     * File with image
     */
    public function set_image_file($value)
    {
        $this->image_file = $value;
        return $this;
    }
	
    /*
     * Original document folder.
     */
    public function get_folder()
    {
        return $this->folder;
    }

    /*
     * Original document folder.
     */
    public function set_folder($value)
    {
        $this->folder = $value;
        return $this;
    }
	
    /*
     * File storage, which have to be used.
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /*
     * File storage, which have to be used.
     */
    public function set_storage($value)
    {
        $this->storage = $value;
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
	
    /*
     * Result name of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public function get_dest_file_name()
    {
        return $this->dest_file_name;
    }

    /*
     * Result name of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public function set_dest_file_name($value)
    {
        $this->dest_file_name = $value;
        return $this;
    }
	
    /*
     * Initials of the author to use for revisions.If you set this parameter and then make some changes to the document programmatically, save the document and later open the document in MS Word you will see these changes as revisions.
     */
    public function get_revision_author()
    {
        return $this->revision_author;
    }

    /*
     * Initials of the author to use for revisions.If you set this parameter and then make some changes to the document programmatically, save the document and later open the document in MS Word you will see these changes as revisions.
     */
    public function set_revision_author($value)
    {
        $this->revision_author = $value;
        return $this;
    }
	
    /*
     * The date and time to use for revisions.
     */
    public function get_revision_date_time()
    {
        return $this->revision_date_time;
    }

    /*
     * The date and time to use for revisions.
     */
    public function set_revision_date_time($value)
    {
        $this->revision_date_time = $value;
        return $this;
    }
	
    /*
     * The watermark rotation angle.
     */
    public function get_rotation_angle()
    {
        return $this->rotation_angle;
    }

    /*
     * The watermark rotation angle.
     */
    public function set_rotation_angle($value)
    {
        $this->rotation_angle = $value;
        return $this;
    }
	
    /*
     * The image file server full name. If the name is empty the image is expected in request content.
     */
    public function get_image()
    {
        return $this->image;
    }

    /*
     * The image file server full name. If the name is empty the image is expected in request content.
     */
    public function set_image($value)
    {
        $this->image = $value;
        return $this;
    }
}