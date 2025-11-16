<!-- Choose area starts -->
<section class="new_choose_area why-choose-section padding-top-50 padding-bottom-50" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color:{{$section_bg}}">
    <div class="container">
        <div class="new_sectionTitle">
            <h2 class="title">{{ $section_title }}</h2>
            <p class="section-para">{{ $subtitle }}</p>
            <div class="explore-btn mt-4">
                <div class="btn-wrapper" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    @if(!empty($customer_btn_text))
                    <a href="{{ $customer_btn_link }}" class="cmn-btn btn-bg-1 radius-5" style="padding: 1rem 2.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; font-weight: 600; border-radius: 12px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                        <i class="fa-solid fa-user-plus"></i>{{ $customer_btn_text }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            @foreach($repeater_data['title_'] as $key => $title)
            <div class="col-xl-4 col-md-6">
                <div class="new_choose__single radius-10">
                    <div class="new_choose__single__flex">
                        <div class="new_choose__single__icon">
                            <a href="javascript:void(0)" class="market_place_image_size">
                               {!! render_image_markup_by_attachment_id($repeater_data['image_'][$key]) !!}
                            </a>
                        </div>
                        <div class="new_choose__single__contents">
                            <h5 class="new_choose__single__title"> {{ $title }} </h5>
                            <p class="new_choose__single__para">{{ $repeater_data['description_'][$key] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.why-choose-section .cmn-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5) !important;
}

.why-choose-section .btn-outline-1:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: #fff !important;
    border-color: transparent !important;
}

@media (max-width: 768px) {
    .why-choose-section .btn-wrapper {
        flex-direction: column;
        align-items: stretch !important;
    }
    .why-choose-section .cmn-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
<!-- Choose area end -->