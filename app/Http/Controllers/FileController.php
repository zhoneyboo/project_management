<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class FileController extends Controller
{


	public function test_upload(Request $request)
	{
		$data = $request->file('files');
		foreach ($data as $value) {
			$path = Storage::putFile('avatars', $value);
		}
		// return $request->input('folder');
	}

	
	// This will be out file upload controller

	public static function uf_base64($base64_file, $path, $filename = null)
	{
		// lets create a pool of letters for our random file name
	    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $file = $base64_file;

	    $check_base64 = strrpos($file, "base64"); // check if the file request is a valid base64 file

	    if($check_base64 > 0)
	    {
	    	// if true it is a valid base64 file
	    	$explode = explode(",", $file);
	    	// $explode[0] = position the base64 raw information
	    	// $explode[1] = position the base 64 file

	    	// decode the base64 file

	    	$decoded_file = base64_decode($explode[1]); // --> valid file

	    	// Creating random file name

	    	$date = date('dmyYHis'); // i would like to use date to make more unique
	    	$random_string = substr(str_shuffle(str_repeat($pool, 5)),0,10);

	    	// get the file extension

	    	$file_extension = self::uf_get_base64_file_extension($explode[0]); // we will pass the raw base64 information

	    	// now lets create our filename
	    	if($filename == null)
	    	{
		    	$filename = $date. $random_string . '.' . $file_extension;
	    	}else{
	    		$filename .= '.' . $file_extension;
	    	}

	    	// now lets store it on our local storage

	    	Storage::disk('public')->put($path. "/" . $filename, $decoded_file, 'public');
	    	// lets return the path
	    	$url = $path . "/" . $filename;
	    	return $url;
	    }
	    else
	    {
	    	return $file;
	    }
	}

	// file extension function

	public static function uf_get_base64_file_extension($base64_raw_info)
	{
		// We will now get the MIME type of the base64 using the $base65 raw information

		$mime = str_replace(';base64', '', $base64_raw_info); // we will trimed the base64 raw information
		$mime = str_replace('data:', '', $mime); // this last trimmed will be result into the mime type of the file

		$extension_arr = [
				"audio/aac" => "aac",
				"application/x-abiword" => "abw",
				"application/octet-stream" => "arc",
				"video/x-msvideo" => "avi",
				"application/vnd.amazon.ebook" => "azw",
				"application/octet-stream" => "bin",
				"image/bmp" => "bmp",
				"application/x-bzip" => "bz",
				"application/x-bzip2" => "bz2",
				"application/x-csh" => "csh",
				"text/css" => "css",
				"text/csv" => "csv",
				"application/msword" => "doc",
				"application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx",
				"application/vnd.ms-fontobject" => "eot",
				"application/epub+zip" => "epub",
				"application/ecmascript" => "es",
				"image/gif" => "gif",
				"text/html" => "html",
				"image/x-icon" => "ico",
				"text/calendar" => "ics",
				"application/java-archive" => "jar",
				"image/jpeg" => "jpeg",
				"application/javascript" => "js",
				"application/json" => "json",
				"audio/midi audio/x-midi" => "midi",
				"video/mpeg" => "mpeg",
				"application/vnd.apple.installer+xml" => "mpkg",
				"application/vnd.oasis.opendocument.presentation" => "odp",
				"application/vnd.oasis.opendocument.spreadsheet" => "ods",
				"application/vnd.oasis.opendocument.text" => "odt",
				"audio/ogg" => "oga",
				"video/ogg" => "ogv",
				"application/ogg" => "ogx",
				"font/otf" => "otf",
				"image/png" => "png",
				"application/pdf" => "pdf",
				"application/vnd.ms-powerpoint" => "ppt",
				"application/vnd.openxmlformats-officedocument.presentationml.presentation" => "pptx",
				"application/x-rar-compressed" => "rar",
				"application/rtf" => "rtf",
				"application/x-sh" => "sh",
				"image/svg+xml" => "svg",
				"application/x-shockwave-flash" => "swf",
				"application/x-tar" => "tar",
				"image/tiff" => "tiff",
				"application/typescript" => "ts",
				"font/ttf" => "ttf",
				"text/plain" => "txt",
				"application/vnd.visio" => "vsd",
				"audio/wav" => "wav",
				"audio/webm" => "weba",
				"video/webm" => "webm",
				"image/webp" => "webp",
				"image/woff" => "woff",
				"font/woff2" => "woff2",
				"application/xhtml+xml" => "xhtml",
				"application/vnd.ms-excel" => "xls",
				"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "xlsx",
				"application/xml" => "xml",
				"application/vnd.mozilla.xul+xml" => "xul",
				"application/zip" => "zip",
				"video/3gpp" => "3gp",
				"audio/3gpp" => "3gp",
				"video/3gpp2" => "3g2",
				"audio/3gpp2" => "3g2",
				"application/x-7z-compressed" => "7z",
			]; // I created this array before hand ^_^ this set containes the mime type and its file extension

			// using the mime type
			// lets return the real file extension

			return $extension_arr[$mime]; // this will return the file extension
	}


	   


}
