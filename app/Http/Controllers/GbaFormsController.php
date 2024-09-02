<?php

namespace App\Http\Controllers;

use App\Models\GbaForms;
use Illuminate\Http\Request;

use Imagick;

class GbaFormsController extends Controller
{
    public function index()
    {
        $forms = GbaForms::all();
        return view('gba-forms.index', compact('forms'));
    }

    public function show($id)
    {
        $form = GbaForms::findOrFail($id);

        // Create an instance of Imagick
        $imagick = new Imagick();

        // Read the image from the raw binary data
        $imagick->readImageBlob($form->DocImage);

        // Convert the image to JPEG
        $imagick->setImageFormat('jpeg');

        // Get the binary data of the JPEG image
        $jpegData = $imagick->getImagesBlob();

        // Create a base64 encoded string for use in the src attribute
        $src = 'data:image/jpeg;base64,' . base64_encode($jpegData);

        return view('gba-forms.show', compact('form', 'src'));
    }
}
