<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCustomStyles;
use Illuminate\Support\Facades\File;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function index()
    {
        $styles = UserCustomStyles::where('users_id', Auth::id())->first();

        Debugbar::info($styles);
        // If there's no styles for the user, you could provide some defaults or redirect
        if (!$styles) {
            $styles = UserCustomStyles::where('users_id', 'default')->first(); // if you have default styles
        }
        $css = view('dynamic_styles', ['styles' => $styles])->render();

        \File::put(public_path('css/dynamic_styles.css'), $css);

        return view('customize-theme', compact('styles'));
    }

    public function index2()
    {
        $styles = UserCustomStyles::where('user_id', Auth::id())->first();
        // dd($styles);
        // If there's no styles for the user, you could provide some defaults or redirect
        if (!$styles) {
            $styles = UserCustomStyles::where('user_id', 'default')->first(); // if you have default styles
        }

        return view('dynamic_styles', compact('styles'));
    }

    public function index3()
    {
        $styles = UserCustomStyles::where('user_id', Auth::id())->first();
        // dd($styles);
        // If there's no styles for the user, you could provide some defaults or redirect
        if (!$styles) {
            $styles = UserCustomStyles::where('user_id', 'default')->first(); // if you have default styles
        }
        // dd($styles);
        return view('home', compact('styles'));
    }
    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $customStyles = UserCustomStyles::where('user_id', $id)->first();

        return view('user.show', compact('user', 'customStyles'));
    }

    public function saveStyles(Request $request)
    {
        $userId = Auth::id(); // Retrieve the currently authenticated user's ID
        $styles = $request->all(); // Get all request data
        // dd($styles);
        $userStyles = UserCustomStyles::updateOrCreate(
            ['users_id' => $userId],
            [
                'body_color' => $styles['bodyColor'],
                'body_bg' => $styles['bodyBg'],
                'button_color' => $styles['buttonColor'],
                'text_color' => $styles['textColor'],
                'div_border_color' => $styles['divBorderColor'],
                'font_size' => $styles['fontSize'],
                'font_weight' => $styles['fontWeight'],
                'font_family' => $styles['fontFamily'],
                'button_border_radius' => $styles['buttonBorderRadius'],
                'paragraph_margin' => $styles['paragraphMargin'],
                'div_margin' => $styles['divMargin'],
                'div_padding' => $styles['divPadding'],

                //     'body_color' => $styles['bodyColor'],
                // 'page_bg' => $styles['pageBg'],
                // 'body_color_rgb' => $styles['bodyColorRgb'],
                // 'body_bg' => $styles['bodyBg'],
                // 'body_bg_rgb' => $styles['bodyBgRgb'],
                // 'header_desktop_fixed_bg_color' => $styles['headerDesktopFixedBgColor'],
                // 'header_desktop_fixed_shadow' => $styles['headerDesktopFixedShadow'],
                // 'header_desktop_bottom' => $styles['headerDesktopBottom'],
                // 'header_tablet_and_mobile' => $styles['headerTabletAndMobile'],
                // 'header_tablet_and_mobile_shadow' => $styles['headerTabletAndMobileShadow'],
                // 'aside_scrollbar_hover_color' => $styles['asideScrollbarHoverColor'],
                // 'app_blank_bg' => $styles['appBlankBg'],
                // 'menu_dropdown_bg_color' => $styles['menuDropdownBgColor'],
                // 'button_color' => $styles['buttonColor'],
                // 'text_color' => $styles['textColor'],
                // 'div_border_color' => $styles['divBorderColor'],
                // 'font_size' => $styles['fontSize'],
                // 'font_weight' => $styles['fontWeight'],
                // 'font_family' => $styles['fontFamily'],
                // 'button_border_radius' => $styles['buttonBorderRadius'],
                // 'paragraph_margin' => $styles['paragraphMargin'],
                // 'div_margin' => $styles['divMargin'],
                // 'div_padding' => $styles['divPadding'],
            ],
        );
        // dd($styles);

        return back()
            ->with('message', 'Styles saved successfully!')
            ->with('success', 'User styles saved!');
        // return redirect()->route('user.show', ['id' => $userId])->with('message', 'Styles saved successfully!');
        // return redirect()->route('show', ['user' => Auth::id()])->with('message', 'Styles saved successfully!');
    }
}
