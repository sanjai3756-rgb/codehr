@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>



<!-- SETTINGS CARD -->
<div class="settings-card">

    <!-- HEADER -->
    <div class="settings-header">

        <div>

            <h2>Website Settings</h2>

            <p>
                Customize website branding and appearance
            </p>

        </div>

    </div>



    <!-- SUCCESS -->
    @if(session('success'))

        <div class="toast-success"
             id="toast">

            {{ session('success') }}

        </div>

    @endif



    <!-- FORM -->
    <form method="POST"
          action="/settings/update"
          enctype="multipart/form-data">

        @csrf



        <div class="settings-grid">

            <!-- WEBSITE NAME -->
            <div class="form-group">

                <label>

                    Website Name

                </label>

                <input type="text"
                       name="website_name"
                       value="{{ $setting->website_name ?? '' }}"
                       placeholder="Enter Website Name">

            </div>



            <!-- THEME COLOR -->
            <div class="form-group">

                <label>

                    Theme Color

                </label>

                <input type="color"
                       name="theme_color"
                       value="{{ $setting->theme_color ?? '#2563eb' }}"
                       class="color-picker">

            </div>



            <!-- FONT STYLE -->
            <div class="form-group">

                <label>

                    Font Style

                </label>

                <select name="font_family">

                    <option value="Poppins">

                        Poppins

                    </option>

                    <option value="Inter">

                        Inter

                    </option>

                    <option value="Roboto">

                        Roboto

                    </option>

                    <option value="Montserrat">

                        Montserrat

                    </option>

                </select>

            </div>



            <!-- LOGO -->
            <div class="form-group full-width">

                <label>

                    Upload Logo

                </label>

                <input type="file"
                       name="logo">

            </div>



            <!-- PREVIEW -->
            @if($setting && $setting->logo)

                <div class="logo-preview">

                    <img src="{{ asset('uploads/settings/'.$setting->logo) }}">

                </div>

            @endif

        </div>



        <!-- BUTTON -->
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Save Settings

            </button>

        </div>

    </form>

</div>

@endsection