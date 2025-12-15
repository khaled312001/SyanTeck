<!-- Vision 2030 Banner Section -->
<section class="vision-2030-banner-section section-padding" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background: linear-gradient(135deg, {{$section_bg}} 0%, #004d26 100%); position: relative; overflow: hidden;">
    <!-- Background Gear Pattern -->
    <div class="vision-2030-gear-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 400px; opacity: 0.15; z-index: 1;">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
            <g fill="none" stroke="rgba(255, 215, 0, 0.3)" stroke-width="2">
                <circle cx="100" cy="100" r="80"/>
                <path d="M100,20 L105,40 L95,40 Z M180,100 L160,105 L160,95 Z M100,180 L95,160 L105,160 Z M20,100 L40,95 L40,105 Z"/>
                <circle cx="100" cy="100" r="50"/>
            </g>
        </svg>
    </div>
    <!-- Background Pattern -->
    <div class="vision-2030-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="1"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>');"></div>
    
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7">
                <div class="vision-2030-content" style="position: relative; z-index: 2;">
                    <div style="background: rgba(0, 0, 0, 0.3); padding: 25px 30px; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <div style="display: flex; align-items: flex-start; gap: 20px; flex-wrap: wrap;">
                            <div style="background: rgba(255, 215, 0, 0.2); padding: 12px 15px; border-radius: 10px; backdrop-filter: blur(5px); border: 1px solid rgba(255, 215, 0, 0.3); flex-shrink: 0;">
                                <i class="las la-flag" style="color: #FFD700; font-size: 36px;"></i>
                            </div>
                            <div style="flex: 1;">
                                <h3 style="color: #FFFFFF; font-size: 26px; font-weight: 800; margin: 0 0 15px 0; text-shadow: 0 2px 10px rgba(0,0,0,0.3); line-height: 1.4;">
                                    {{ $title }}
                                </h3>
                                @if(!empty($subtitle))
                                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 17px; margin: 0; line-height: 1.8; font-weight: 400;">
                                        {{ $subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 text-center text-md-left">
                <div class="vision-2030-logo-wrapper" style="position: relative; z-index: 2;">
                    <div style="display: inline-block; transition: all 0.4s ease; position: relative; padding: 15px 20px; border-radius: 15px; background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <img src="{{ asset('assets/frontend/img/Saudi_Vision_2030_logo.svg.png') }}" 
                             alt="رؤية المملكة 2030" 
                             style="max-height: 120px; width: auto; filter: brightness(1.1) drop-shadow(0 6px 15px rgba(0,0,0,0.4)); transition: all 0.4s ease; display: block;"
                             onerror="this.onerror=null; this.src='{{ asset('assets/frontend/img/Saudi_Vision_2030_logo.svg.png') }}';">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.vision-2030-banner-section {
    position: relative;
}

.vision-2030-banner-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 1;
}

.vision-2030-banner-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 1;
}

.vision-2030-logo-wrapper a {
    display: inline-block;
}

.vision-2030-logo-wrapper:hover {
    transform: scale(1.05);
}

.vision-2030-logo-wrapper:hover {
    transform: scale(1.05);
}

.vision-2030-logo-wrapper img {
    transition: all 0.4s ease;
}

.vision-2030-logo-wrapper:hover img {
    filter: brightness(1.2) drop-shadow(0 8px 20px rgba(255,215,0,0.4)) !important;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .vision-2030-banner-section h3 {
        font-size: 20px !important;
    }
    
    .vision-2030-banner-section p {
        font-size: 14px !important;
    }
    
    .vision-2030-banner-section .las {
        font-size: 32px !important;
    }
    
    .vision-2030-logo-wrapper img {
        max-height: 60px !important;
    }
}
</style>

