<!-- Main Departments Section -->
<section class="main-departments-section section-padding" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color: {{$section_bg}}; position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div class="departments-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.03; background-image: url('data:image/svg+xml,<svg width=\"100\" height=\"100\" xmlns=\"http://www.w3.org/2000/svg\"><defs><pattern id=\"grid\" width=\"50\" height=\"50\" patternUnits=\"userSpaceOnUse\"><path d=\"M 50 0 L 0 0 0 50\" fill=\"none\" stroke=\"%23000000\" stroke-width=\"1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>'); z-index: 0;"></div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <!-- Section Header -->
        <div class="section-header text-center margin-bottom-60">
            <h2 class="section-title" style="font-size: 42px; font-weight: 800; color: #000000; margin-bottom: 20px; line-height: 1.3;">
                {{ $title }}
            </h2>
            @if(!empty($subtitle))
            <p class="section-subtitle" style="font-size: 18px; color: #666; max-width: 700px; margin: 0 auto; line-height: 1.8;">
                {{ $subtitle }}
            </p>
            @endif
        </div>

        <!-- Departments Grid -->
        <div class="row justify-content-center">
            <!-- Department 1: Maintenance (Available) -->
            <div class="col-lg-4 col-md-6 col-sm-12 margin-bottom-30">
                <div class="department-card department-card-active">
                    <div class="department-card-inner">
                        <div class="department-icon-wrapper">
                            <div class="department-icon-circle">
                                <i class="las la-tools"></i>
                            </div>
                            <div class="department-status-badge status-available">
                                <i class="las la-check-circle"></i>
                                <span>{{__('متاح الآن')}}</span>
                            </div>
                        </div>
                        <div class="department-content">
                            <h3 class="department-title">{{__('صيانة')}}</h3>
                            <p class="department-description">
                                {{__('خدمات صيانة شاملة ومتكاملة لجميع احتياجاتك اليومية. فريقنا المحترف والمعتمد يضمن لك الحلول السريعة والفعالة.')}}
                            </p>
                            <div class="department-features">
                                <div class="feature-item">
                                    <i class="las la-check"></i>
                                    <span>{{__('صيانة كهربائية')}}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="las la-check"></i>
                                    <span>{{__('صيانة سباكة')}}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="las la-check"></i>
                                    <span>{{__('صيانة تكييف')}}</span>
                                </div>
                            </div>
                            <a href="{{route('qr.index')}}" class="department-btn">
                                {{__('اطلب الخدمة')}}
                                <i class="las la-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department 2: Finishing (Coming Soon) -->
            <div class="col-lg-4 col-md-6 col-sm-12 margin-bottom-30">
                <div class="department-card department-card-coming-soon">
                    <div class="department-card-inner">
                        <div class="department-icon-wrapper">
                            <div class="department-icon-circle">
                                <i class="las la-paint-roller"></i>
                            </div>
                            <div class="department-status-badge status-coming-soon">
                                <i class="las la-clock"></i>
                                <span>{{__('قريباً')}}</span>
                            </div>
                        </div>
                        <div class="department-content">
                            <h3 class="department-title">{{__('تشطيب')}}</h3>
                            <p class="department-description">
                                {{__('خدمات تشطيب واحترافية لتحويل منزلك إلى جنة حقيقية. سنوفر قريباً خدمات الدهان والديكور والنجارة.')}}
                            </p>
                            <div class="department-features">
                                <div class="feature-item disabled">
                                    <i class="las la-paint-brush"></i>
                                    <span>{{__('دهان وديكور')}}</span>
                                </div>
                                <div class="feature-item disabled">
                                    <i class="las la-hammer"></i>
                                    <span>{{__('نجارة')}}</span>
                                </div>
                                <div class="feature-item disabled">
                                    <i class="las la-couch"></i>
                                    <span>{{__('أعمال تشطيب')}}</span>
                                </div>
                            </div>
                            <div class="department-btn disabled">
                                {{__('قريباً')}}
                                <i class="las la-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department 3: Establishment (Coming Soon) -->
            <div class="col-lg-4 col-md-6 col-sm-12 margin-bottom-30">
                <div class="department-card department-card-coming-soon">
                    <div class="department-card-inner">
                        <div class="department-icon-wrapper">
                            <div class="department-icon-circle">
                                <i class="las la-building"></i>
                            </div>
                            <div class="department-status-badge status-coming-soon">
                                <i class="las la-clock"></i>
                                <span>{{__('قريباً')}}</span>
                            </div>
                        </div>
                        <div class="department-content">
                            <h3 class="department-title">{{__('تأسيس')}}</h3>
                            <p class="department-description">
                                {{__('خدمات تأسيس متكاملة للمشاريع الجديدة. سنوفر قريباً خدمات التأسيس الكهربائي والسباكة والبنية التحتية.')}}
                            </p>
                            <div class="department-features">
                                <div class="feature-item disabled">
                                    <i class="las la-bolt"></i>
                                    <span>{{__('تأسيس كهربائي')}}</span>
                                </div>
                                <div class="feature-item disabled">
                                    <i class="las la-pipe"></i>
                                    <span>{{__('تأسيس سباكة')}}</span>
                                </div>
                                <div class="feature-item disabled">
                                    <i class="las la-hard-hat"></i>
                                    <span>{{__('أعمال تأسيس')}}</span>
                                </div>
                            </div>
                            <div class="department-btn disabled">
                                {{__('قريباً')}}
                                <i class="las la-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Main Departments Section Styles */
.main-departments-section {
    position: relative;
    background: #FFFFFF;
}

.section-header {
    margin-bottom: 60px;
}

.section-title {
    font-size: 42px;
    font-weight: 800;
    color: #000000;
    margin-bottom: 20px;
    line-height: 1.3;
    letter-spacing: -0.5px;
}

.section-subtitle {
    font-size: 18px;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

/* Department Cards */
.department-card {
    height: 100%;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.department-card-inner {
    background: #FFFFFF;
    border-radius: 25px;
    padding: 40px 35px;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 3px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.department-card-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
    transform: scaleX(0);
    transition: transform 0.4s ease;
    transform-origin: left;
}

.department-card-active .department-card-inner {
    border-color: #000000;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFAFA 100%);
}

.department-card-active .department-card-inner::before {
    transform: scaleX(1);
}

.department-card-coming-soon .department-card-inner {
    opacity: 0.6;
    filter: grayscale(0.3);
    background: linear-gradient(135deg, #F5F5F5 0%, #E8E8E8 100%);
    border-color: rgba(0, 0, 0, 0.15);
}

.department-card:hover .department-card-inner {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.department-card-coming-soon:hover .department-card-inner {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
}

/* Department Icon */
.department-icon-wrapper {
    position: relative;
    text-align: center;
    margin-bottom: 30px;
}

.department-icon-circle {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1;
}

.department-card-coming-soon .department-icon-circle {
    background: linear-gradient(135deg, #CCCCCC 0%, #999999 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    filter: grayscale(0.5);
}

.department-icon-circle i {
    font-size: 60px;
    color: #000000;
    transition: all 0.3s ease;
}

.department-card-coming-soon .department-icon-circle i {
    color: #666666;
}

.department-card:hover .department-icon-circle {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.5);
}

.department-card-coming-soon:hover .department-icon-circle {
    transform: scale(1.05);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

/* Status Badge */
.department-status-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    z-index: 2;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: pulseBadge 2s ease-in-out infinite;
}

.status-available {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #FFFFFF;
}

.status-coming-soon {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: #FFFFFF;
}

@keyframes pulseBadge {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.department-status-badge i {
    font-size: 16px;
}

/* Department Content */
.department-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.department-title {
    font-size: 32px;
    font-weight: 800;
    color: #000000;
    margin-bottom: 20px;
    text-align: center;
    line-height: 1.3;
}

.department-card-coming-soon .department-title {
    color: #666666;
}

.department-description {
    font-size: 15px;
    color: #666;
    line-height: 1.8;
    margin-bottom: 25px;
    text-align: center;
    flex: 1;
}

.department-card-coming-soon .department-description {
    color: #999;
}

/* Department Features */
.department-features {
    margin-bottom: 30px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.department-card-coming-soon .feature-item {
    background: rgba(0, 0, 0, 0.05);
    opacity: 0.7;
}

.feature-item.disabled {
    background: rgba(0, 0, 0, 0.03);
    opacity: 0.6;
}

.feature-item i {
    font-size: 18px;
    color: #FFD700;
    flex-shrink: 0;
}

.feature-item.disabled i {
    color: #999;
}

.feature-item span {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.feature-item.disabled span {
    color: #999;
}

.department-card:hover .feature-item:not(.disabled) {
    background: rgba(255, 215, 0, 0.15);
    border-color: rgba(255, 215, 0, 0.3);
    transform: translateX(5px);
}

/* Department Button */
.department-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 16px 30px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #000000;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
    cursor: pointer;
    width: 100%;
    margin-top: auto;
}

.department-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
    background: linear-gradient(135deg, #FFA500 0%, #FFD700 100%);
    color: #000000;
}

.department-btn i {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.department-btn:hover i {
    transform: translateX(-5px);
}

.department-btn.disabled {
    background: linear-gradient(135deg, #CCCCCC 0%, #999999 100%);
    color: #666666;
    cursor: not-allowed;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.department-btn.disabled:hover {
    transform: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 991px) {
    .section-title {
        font-size: 36px;
    }
    
    .section-subtitle {
        font-size: 16px;
    }
    
    .department-card-inner {
        padding: 35px 30px;
    }
    
    .department-icon-circle {
        width: 100px;
        height: 100px;
    }
    
    .department-icon-circle i {
        font-size: 50px;
    }
    
    .department-title {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 32px;
    }
    
    .section-subtitle {
        font-size: 15px;
    }
    
    .department-card-inner {
        padding: 30px 25px;
    }
    
    .department-icon-circle {
        width: 90px;
        height: 90px;
    }
    
    .department-icon-circle i {
        font-size: 45px;
    }
    
    .department-title {
        font-size: 24px;
    }
    
    .department-description {
        font-size: 14px;
    }
    
    .feature-item {
        padding: 10px 12px;
    }
    
    .feature-item span {
        font-size: 13px;
    }
    
    .department-btn {
        padding: 14px 25px;
        font-size: 15px;
    }
}
</style>

