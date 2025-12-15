<style>
    :root {
        --main-color-one: #FFD700;
        --main-color-two: #FFD700;
        --main-color-three: #FFD700;
        --heading-color: #000000;
        --light-color: #666666;
        --extra-light-color: #999999;

        --heading-font: 'Almarai', {{get_static_option('heading_font_family') ? get_static_option('heading_font_family') . ',' : ''}}sans-serif;
        --body-font: 'Almarai', {{get_static_option('body_font_family') ? get_static_option('body_font_family') . ',' : ''}}sans-serif;

          @if(!empty(Auth::guard('web')->user()->user_typ) == 0)
              @if(request()->is('seller/*'))
                --main-color-one: #FFD700;
                --main-color-one-rgb: 255, 215, 0;
              @endif
           @endif
        }
    </style>



