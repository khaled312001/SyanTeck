@php
    // الحصول على لوجو الموقع
    $site_logo = get_static_option('site_logo');
    $logo_image = get_attachment_image_by_id($site_logo, 'full', false);
    $logo_url = !empty($logo_image) ? $logo_image['img_url'] : asset('assets/uploads/no-image.png');
@endphp

<!-- العلامة المائية وحماية النسخ -->
<style>
    /* العلامة المائية */
    .site-watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0.05;
        z-index: 999999;
        pointer-events: none;
        user-select: none;
        max-width: 400px;
        max-height: 400px;
        width: auto;
        height: auto;
    }
    
    .site-watermark img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 0 5px rgba(0,0,0,0.1));
    }
    
    /* منع تحديد النص */
    body {
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
        -webkit-touch-callout: none !important;
    }
    
    /* السماح بتحديد النص في حقول الإدخال */
    input, textarea, select, [contenteditable="true"] {
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
        user-select: text !important;
    }
    
    /* منع سحب الصور */
    img:not(.logo img):not(.navbar img):not(.footer img):not(.site-watermark img):not(.btn img):not(.button img) {
        -webkit-user-drag: none !important;
        -khtml-user-drag: none !important;
        -moz-user-drag: none !important;
        -o-user-drag: none !important;
        user-drag: none !important;
    }
    
    /* السماح بالتفاعل مع الصور في بعض الحالات الخاصة */
    .logo img, .navbar img, .footer img, 
    .site-watermark img, .btn img, .button img,
    img.btn, img.button, img[role="button"],
    .navbar-area img, .header img {
        -webkit-user-drag: auto !important;
        -khtml-user-drag: auto !important;
        -moz-user-drag: auto !important;
        -o-user-drag: auto !important;
        user-drag: auto !important;
    }
    
    /* رسالة عند محاولة النسخ */
    .copy-protection-message {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #ff4444;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 9999999;
        display: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        font-family: 'Almarai', sans-serif;
        font-weight: 700;
    }
</style>

<!-- العلامة المائية -->
<div class="site-watermark">
    <img src="{{ $logo_url }}" alt="Watermark">
</div>

<!-- رسالة الحماية -->
<div class="copy-protection-message" id="copyProtectionMessage">
    {{ __('النسخ محظور') }}
</div>

<script>
(function() {
    'use strict';
    
    // الحصول على لوجو الموقع
    var logoUrl = @json($logo_url);
    
    // منع النقر بالزر الأيمن
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        showProtectionMessage();
        return false;
    }, false);
    
    // منع اختصارات لوحة المفاتيح (Ctrl+C, Ctrl+A, Ctrl+V, Ctrl+S, F12, Ctrl+Shift+I, Ctrl+U)
    document.addEventListener('keydown', function(e) {
        // Ctrl+C, Ctrl+A, Ctrl+V, Ctrl+S
        if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 65 || e.keyCode === 86 || e.keyCode === 83)) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
        
        // F12 (Developer Tools)
        if (e.keyCode === 123) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
        
        // Ctrl+Shift+I (Developer Tools)
        if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
        
        // Ctrl+U (View Source)
        if (e.ctrlKey && e.keyCode === 85) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
        
        // Ctrl+Shift+C (Inspect Element)
        if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
        
        // Ctrl+P (Print)
        if (e.ctrlKey && e.keyCode === 80) {
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
    }, false);
    
    // منع النسخ
    document.addEventListener('copy', function(e) {
        e.preventDefault();
        showProtectionMessage();
        return false;
    }, false);
    
    // منع القص
    document.addEventListener('cut', function(e) {
        e.preventDefault();
        showProtectionMessage();
        return false;
    }, false);
    
    // منع اللصق
    document.addEventListener('paste', function(e) {
        e.preventDefault();
        showProtectionMessage();
        return false;
    }, false);
    
    // منع تحديد النص
    document.addEventListener('selectstart', function(e) {
        // السماح بتحديد النص في حقول الإدخال
        if (e.target.tagName === 'INPUT' || 
            e.target.tagName === 'TEXTAREA' || 
            e.target.isContentEditable) {
            return true;
        }
        e.preventDefault();
        return false;
    }, false);
    
    // منع سحب الصور
    document.addEventListener('dragstart', function(e) {
        if (e.target.tagName === 'IMG') {
            // السماح بسحب الصور في بعض الحالات الخاصة
            if (e.target.closest('.logo') || 
                e.target.closest('.navbar') || 
                e.target.closest('.footer') ||
                e.target.classList.contains('button') ||
                e.target.classList.contains('btn')) {
                return true;
            }
            e.preventDefault();
            showProtectionMessage();
            return false;
        }
    }, false);
    
    // منع حفظ الصور (النقر بالزر الأيمن على الصور) - استخدام event delegation
    document.addEventListener('contextmenu', function(e) {
        if (e.target.tagName === 'IMG') {
            var img = e.target;
            // السماح بالتفاعل مع الصور في بعض الحالات الخاصة
            if (!img.closest('.logo') && 
                !img.closest('.logo-wrapper') &&
                !img.closest('.navbar') && 
                !img.closest('.navbar-area') &&
                !img.closest('.header') &&
                !img.closest('.footer') &&
                !img.closest('.btn') &&
                !img.closest('.button') &&
                !img.classList.contains('button') &&
                !img.classList.contains('btn') &&
                !img.closest('a') &&
                !img.closest('.site-watermark')) {
                e.preventDefault();
                showProtectionMessage();
                return false;
            }
        }
    }, false);
    
    // منع فتح الصورة في تبويب جديد
    document.addEventListener('click', function(e) {
        if (e.target.tagName === 'IMG' && (e.ctrlKey || e.metaKey)) {
            var img = e.target;
            // السماح بالتفاعل مع الصور في بعض الحالات الخاصة
            if (!img.closest('.logo') && 
                !img.closest('.logo-wrapper') &&
                !img.closest('.navbar') && 
                !img.closest('.navbar-area') &&
                !img.closest('.header') &&
                !img.closest('.footer') &&
                !img.closest('.btn') &&
                !img.closest('.button') &&
                !img.classList.contains('button') &&
                !img.classList.contains('btn') &&
                !img.closest('a') &&
                !img.closest('.site-watermark')) {
                e.preventDefault();
                showProtectionMessage();
                return false;
            }
        }
    }, false);
    
    // إضافة العلامة المائية على الصور ديناميكياً
    function addWatermarkToImages() {
        var images = document.querySelectorAll('img:not(.site-watermark img)');
        images.forEach(function(img) {
            // تخطي الصور في العلامة المائية واللوجو
            if (img.closest('.site-watermark') || 
                img.closest('.logo') || 
                img.closest('.navbar') || 
                img.closest('.footer')) {
                return;
            }
            
            // إضافة علامة مائية على الصور باستخدام canvas (اختياري)
            // يمكن تفعيلها لاحقاً إذا لزم الأمر
        });
    }
    
    // منع فتح Developer Tools
    var devtools = {
        open: false,
        orientation: null
    };
    
    setInterval(function() {
        if (window.outerHeight - window.innerHeight > 200 || 
            window.outerWidth - window.innerWidth > 200) {
            if (!devtools.open) {
                devtools.open = true;
                showProtectionMessage();
            }
        } else {
            devtools.open = false;
        }
    }, 500);
    
    // منع طباعة الصفحة
    window.addEventListener('beforeprint', function(e) {
        e.preventDefault();
        showProtectionMessage();
        return false;
    }, false);
    
    // عرض رسالة الحماية
    function showProtectionMessage() {
        var message = document.getElementById('copyProtectionMessage');
        if (message) {
            message.style.display = 'block';
            setTimeout(function() {
                message.style.display = 'none';
            }, 2000);
        }
    }
    
    // منع فحص الكود (اختياري - قد يؤثر على الأداء)
    // يمكن إزالة التعليقات لتفعيلها
    /*
    Object.defineProperty(window, 'console', {
        value: {},
        writable: false
    });
    */
    
    // إضافة علامة مائية على الصور عند تحميلها
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', addWatermarkToImages);
    } else {
        addWatermarkToImages();
    }
    
    // مراقبة الصور الجديدة المضافة ديناميكياً
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length) {
                addWatermarkToImages();
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
})();
</script>

