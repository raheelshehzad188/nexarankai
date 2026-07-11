<style>
/* ==========================
HERO
========================== */

.hero{
min-height:100vh;
background-position:center center;
background-size:cover;
background-repeat:no-repeat;
position:relative;
display:flex;
align-items:center;
}

.hero-overlay{

position:absolute;
left:0;
top:0;
width:40%;
height:100%;

background:linear-gradient(
90deg,
rgba(4,16,32,.90) 0%,
rgba(4,16,32,.75) 60%,
transparent 100%
);

}

.hero-content{
position:relative;
z-index:2;
display:flex;
align-items:center;
min-height:100vh;
}

.hero-left{
max-width:500px;
padding-top:90px;
}

.hero-line{
display:block;
width:60px;
height:2px;
background:var(--primary);
margin-bottom:30px;
}

.hero-left h1{

font-family:'Cormorant Garamond',serif;

font-size:72px;

line-height:1;

font-weight:500;

color:#fff;

margin-bottom:25px;

}

.hero-subtitle{

color:var(--primary);

font-size:14px;

font-weight:400;

letter-spacing:3px;

margin-bottom:40px;

}

.hero-features{
display:flex;
flex-direction:column;
margin-bottom:45px;
}

.hero-features .feature-item:last-child{
    border-bottom: 1px solid #ffffff17;
}

.feature-item{
display:flex;
gap:15px;
padding: 15px 0px;
border-top: 1px solid #ffffff17;
}

.feature-item span{
font-size:20px;
color:var(--primary);
}

.feature-item p{
font-size:15px;
color:#fff;
margin: 0px;
}

.hero-btn{

display:inline-flex;

gap:20px;

background:var(--primary);

color:#fff;

padding:16px 28px;

border-radius:6px;

font-weight:600;

transition:.3s;

}

.hero-btn:hover{
background:var(--primary-dark);
}

/* ==========================
TABLET
========================== */

@media(max-width:991px){
.hero-left h1{
font-size:58px;
}
.hero-overlay{
width:60%;
}

}

/* ==========================
MOBILE
========================== */

@media(max-width:768px){

.hero-overlay{
width:100%;
}

.hero-left{

max-width:100%;

padding-top:0px;

}

.hero-left h1{

font-size:48px;

}

.hero-subtitle{
font-size:12px;
}

.feature-item p{
font-size:14px;
}

.hero-btn{
width:100%;
justify-content:center;
}

}

@media(max-width:480px){


 .hero{
        background-image:url("https://clean-air.ae/uploads/hero-banner-mobile.jpeg") !important;
        background-position:center center;
        background-size:cover;
        min-height:700px; /* Adjust if needed */
    }
    .hero-left h1{
    font-size:38px;
    }
    
    .logo img{
    max-width:130px;
    }

}


 /* ========================== PROMISE SECTION ========================== */
        .promise-section {
            background: linear-gradient(135deg, #f9f7f3 0%, #f0ede7 100%);
            padding: 80px 0;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .promise-header {
        
            margin-bottom: 60px;
        }
        
        .promise-eyebrow{
             color: var(--primary);
             font-size: 16px;
            margin-bottom:30px;
        }
        .promise-eyebrow::after{
            content: "";
            display: block;
            width: 82px;
            height: 2px;
            background: #c58b47;
            margin-top: 10px;
        }

        .promise-section h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 44px;
            color: var(--black);
            margin-bottom: 20px;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            line-height: 48px;
        }

        .promise-subtitle {
            font-size: 16px;
            color: var(--black);
            max-width: 600px;
        }
        .promise-features {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            width:50%;
        }

        .promise-item {
            padding: 30px 10px;
            text-align: center;
            border-right: 1px solid #7a7a7a5e;
            transition: var(--transition);
        }

        .promise-features .promise-item:last-child{
            border-right: 0px;
        }
        
        .promise-features2 .promise-item:last-child{
            border-right: 0px;
        }
        
        .promise-item:hover {
            box-shadow: 0 10px 30px rgba(197, 139, 71, 0.1);
            transform: translateY(-5px);
        }

        .promise-item-icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }

        .promise-item h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: var(--black);
            margin-bottom: 10px;
            font-weight: 500;
            line-height: 18px;
        }

        .promise-item p {
            font-size: 11px;
            color: var(--black);
            line-height: 1.4;
            margin: 0;
        }
        
        .promise-features2{
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            width: 70%;
            margin-top: 50px;
            background: #F7EDE5;
            border-radius: 12px;
            padding: 20px;
        }
        .promise-item2{
            display: flex;
            flex-direction: row;
            align-items: center;
            border-right: 1px solid #7a7a7a5e;
            padding: 0px 10px;
        }
        .promise-item2-img{
            width: 50%;
        }
        .promise-item2-content{
            width: 50%;
        }
        
        .promise-item2-content h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: var(--black);
            margin-bottom: 10px;
            font-weight: 500;
            line-height: 18px;
        }

        .promise-item2-content p {
            font-size: 11px;
            color: var(--black);
            line-height: 1.4;
            margin: 0;
        }
        
        @media (max-width:767px){
            .promise-features{
                width: 100%;
            }
            .promise-item{
                border: none;
            }
            .promise-features2{
                grid-template-columns:1fr;
                width: 100%;
            }
            .promise-item2{
                border: none;
            }
        }
        
        /* ========================== RESPONSIVE DESIGN ========================== */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 40px 0;
            }

            .hero-left h1 {
                font-size: 44px;
            }

            .hero-right {
                order: -1;
            }

            .hero-image {
                max-width: 350px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }

            .promise-features {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .promise-section h2 {
                font-size: 36px;
            }

            .feature-card {
                padding: 25px 15px;
            }

            .promise-item {
                padding: 25px 20px;
            }
        }
        @media (max-width: 768px) {
             .hero{
                 background-image:url("https://clean-air.ae/uploads/hero-banner-mobile.jpeg") !important;
                 background-position:center center;
                 background-size:cover;
                min-height:700px; /* Adjust if needed */
            }
            .hero {
                min-height: auto;
                padding: 40px 0;
            }

            .hero-left h1 {
                font-size: 36px;
                margin-bottom: 20px;
            }

            .hero-left p {
                font-size: 15px;
                margin-bottom: 30px;
            }

            .hero-left p.mission {
                padding-top: 20px;
                margin-top: 20px;
                font-size: 14px;
            }

            .hero-image {
                max-width: 100%;
            }

            .features-section {
                padding: 60px 0;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .feature-card {
                padding: 20px 15px;
            }

            .feature-icon {
                font-size: 40px;
                margin-bottom: 15px;
            }
            .feature-card h3 {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .feature-card p {
                font-size: 13px;
            }

            .promise-section {
                padding: 60px 0;
            }

            .promise-header {
                margin-bottom: 40px;
            }

            .promise-section h2 {
                font-size: 32px;
                margin-bottom: 15px;
            }

            .promise-subtitle {
                font-size: 15px;
                margin-bottom: 40px;
            }

            .promise-features {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .promise-item {
                padding: 20px 15px;
            }

            .promise-item h4 {
                font-size: 16px;
            }

            .promise-item p {
                font-size: 11px;
                color: #666;
                line-height: 1.4;
                margin: 0;
            }

            .promise-item-icon {
                font-size: 32px;
                margin-bottom: 10px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .hero {
                padding: 30px 0;
            }

            .hero-left h1 {
                font-size: 28px;
                line-height: 1.3;
                margin-bottom: 15px;
            }

            .hero-label {
                font-size: 12px;
                margin-bottom: 15px;
            }

            .hero-line {
                width: 50px;
                margin-bottom: 20px;
            }

            .hero-left p {
                font-size: 14px;
                margin-bottom: 25px;
                line-height: 1.7;
            }

            .hero-left p.mission {
                font-size: 13px;
                margin-top: 15px;
                padding-top: 15px;
            }

            .features-section {
                padding: 40px 0;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .feature-card {
                padding: 20px;
            }

            .feature-icon {
                font-size: 36px;
                margin-bottom: 12px;
            }

            .feature-card h3 {
                font-size: 16px;
                margin-bottom: 8px;
            }

            .feature-card p {
                font-size: 12px;
            }

            .promise-section {
                padding: 40px 0;
            }

            .promise-badge {
                padding: 12px 20px;
                font-size: 12px;
                margin-bottom: 20px;
            }

            .promise-section h2 {
                font-size: 26px;
                margin-bottom: 12px;
            }

            .promise-subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }
            
            .promise-features {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .promise-item {
                padding: 18px 15px;
            }

            .promise-item h4 {
                font-size: 15px;
                margin-bottom: 8px;
            }

            .promise-item p {
                font-size: 11px;
            }

            .promise-item-icon {
                font-size: 28px;
                margin-bottom: 8px;
            }
        }


/* ==========================
Services SECTION. DIFFERENCE SECTION 
========================== */

.difference-section{
    padding:100px 0;
    background:#faf8f5;
}

.difference-top{
    display:flex;
    gap:60px;
    align-items:center;
}

.difference-content{
    width:35%;
}

.section-eyebrow{
    display:block;
    color:var(--primary);
    font-size:13px;
    letter-spacing:2px;
    font-weight:600;
    margin-bottom:20px;
}

.difference-content h2,
.included-section h2{
    font-family: 'Cormorant Garamond', serif;
    font-size: 44px;
    line-height: 48px;
    color: var(--black);
    margin-bottom: 20px;
    font-weight: 500;
}

.difference-content p{
    color:var(--black);
    line-height:24px;
    font-size:16px;
}

.difference-features{
    margin-top:35px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.diff-feature{
    display:flex;
    align-items:center;
    gap:15px;
}

.diff-feature span{
    color:var(--primary);
    font-size:22px;
}

.diff-feature p{
    margin:0;
    font-size:16px;
    font-weight:500;
}

/* Images */

.difference-images{
    width:65%;
    display:flex;
    position:relative;
}

.before-card,
.after-card{
    width:50%;
    position:relative;
}

.before-card img,
.after-card img{
    width:100%;
    height:420px;
    object-fit:cover;
    display:block;
}

.before-card img{
    border-radius:14px 0 0 14px;
}

.after-card img{
    border-radius:0 14px 14px 0;
}

.image-badge{
    position:absolute;
    bottom:18px;
    left:50%;
    transform:translateX(-50%);
    padding:10px 25px;
    border-radius:40px;
    color:#fff;
    font-size:14px;
    font-weight:600;
}

.image-badge.before{
    background:#222;
}

.image-badge.after{
    background:var(--primary);
}

.slider-icon{
    position:absolute;
    left:50%;
    top:50%;
    transform:translate(-50%,-50%);
    width:60px;
    height:60px;
    background:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 10px 30px rgba(0,0,0,.12);
    font-size:18px;
    z-index:2;
}

/* ==========================
INCLUDED SECTION
========================== */

.included-section{
    padding:90px 0;
    background:#f8f4ef;
}

.included-section h2{
    margin-bottom:60px;
}

.included-grid{
    display:flex;
    flex-wrap:wrap;
    gap:0;
}

.service-card{
    width:16.666%;
    text-align:center;
    padding:15px 15px;
    border-right:1px solid #e7ddd1;
}

.service-card:last-child{
    border-right:none;
}

.service-icon{
    font-size:38px;
    margin-bottom:20px;
    color:var(--primary);
}

.service-card h3{
    font-size:18px;
    margin-bottom:15px;
    color:#172133;
}

.service-card p{
    color:#666;
    font-size:14px;
    line-height:1.7;
    margin:0;
}

/* ==========================
TABLET
========================== */

@media(max-width:991px){

    .difference-top{
        flex-direction:column;
    }

    .difference-content,
    .difference-images{
        width:100%;
    }

    .difference-content h2,
    .included-section h2{
        font-size:48px;
    }

    .included-grid{
        gap:20px;
    }

    .service-card{
        width:calc(33.333% - 14px);
        border:1px solid #e7ddd1;
        border-radius:10px;
    }

}

/* ==========================
MOBILE
========================== */

@media(max-width:767px){

    .difference-section{
        padding:70px 0;
    }

    .included-section{
        padding:70px 0;
    }

    .difference-content h2,
    .included-section h2{
        font-size:38px;
    }

    .difference-images{
        flex-direction:column;
        gap:20px;
    }

    .before-card,
    .after-card{
        width:100%;
    }

    .before-card img,
    .after-card img{
        height:260px;
        border-radius:12px;
    }

    .slider-icon{
        display:none;
    }

    .service-card{
        width:100%;
    }

}



/* ==========================
OUR PROCESS
========================== */

.process-section{
    position: relative;
    padding: 90px 0;
    background: #0d1824;
    overflow: hidden;
}

/* Background Image */

.process-section::before{
    content:"";
    position:absolute;
    inset:0;
    background:url("https://clean-air.ae/uploads/process-bg.png") center right / cover no-repeat;
    opacity:.22;
    pointer-events:none;
}

.process-section::after{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(
        90deg,
        rgba(13,24,36,.97) 0%,
        rgba(13,24,36,.95) 40%,
        rgba(13,24,36,.75) 70%,
        rgba(13,24,36,.35) 100%
    );
    pointer-events:none;
}

.process-section .container{
    position:relative;
    z-index:2;
}

.process-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:70px;
    
}

/* Left */

.process-left{
    width:33%;
}

.process-eyebrow{
    display:inline-block;
    position:relative;
    font-size:13px;
    font-weight:600;
    letter-spacing:2px;
    color:var(--primary);
    text-transform:uppercase;
    margin-bottom:20px;
}

.process-eyebrow::after{
    content:"";
    display:block;
    width:35px;
    height:2px;
    background:var(--primary);
    margin-top:10px;
}

.process-title{
    font-family:'Cormorant Garamond',serif;
    color:#fff;
    font-size:44px;
    line-height:48px;
    font-weight:500;
    margin-bottom:20px;
}

.process-text{
    color:#d8d8d8;
    font-size:16px;
    line-height:1.9;
    margin-bottom:20px;
}

.process-btn{
    margin: 0px;
    display:inline-flex;
    align-items:center;
    gap:18px;
    padding:16px 28px;
    border-radius:6px;
    background:var(--primary);
    color:#fff;
    text-decoration:none;
    transition:var(--transition);
    font-weight:600;

}

.process-btn:hover{

    background:var(--primary-dark);

}

/* Right */

.process-right{

    width:67%;
    display:flex;
    justify-content:space-between;
    gap:20px;

}

.process-card{
    flex:1;
    position:relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Number */

.process-number{

    width:46px;
    height:46px;
    border:2px solid var(--primary);
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#fff;
    font-weight:600;
    margin-bottom:32px;
    position:relative;
    background:#132231;
    z-index:2;

}

/* Dotted line */

.process-line{
    position: absolute;
    top: 22px;
    left: 128px;
    width: calc(100% - 60px);
    border-top: 1px dashed rgba(255, 255, 255, .35);

}

.process-last .process-line{

    display:none;

}

/* Icon */

.process-icon{

    width:70px;
    height:70px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:34px;
    color:var(--primary);
    margin-bottom:18px;

}

.process-card h3{

    font-size:24px;
    font-family:'Cormorant Garamond',serif;
    color:var(--white);
    margin-bottom:12px;
    font-weight:500;

}

.process-card p{
    text-align: center;
    color:var(--white);
    font-size:15px;
    line-height:1.8;
    max-width:170px;
    margin: 0px;
}

/* Hover */

.process-card:hover .process-number{

    background:var(--primary);

}

.process-card:hover .process-icon{

    transform:translateY(-6px);
    transition:.35s;

}

/* ==========================
Tablet
========================== */

@media(max-width:992px){

.process-wrapper{

    flex-direction:column;

}

.process-left,
.process-right{

    width:100%;

}

.process-title{

    font-size:46px;

}

.process-right{

    flex-wrap:wrap;
    gap:35px;

}

.process-card{

    flex:0 0 calc(50% - 18px);

}

.process-line{

    display:none;

}

.process-card p{

    max-width:100%;

}

}

/* ==========================
Mobile
========================== */

@media(max-width:767px){

.process-section{

    padding:70px 0;

}

.process-title{

    font-size:38px;

}

.process-text{

    font-size:15px;

}

.process-right{

    flex-direction:column;
    gap:45px;

}

.process-card{

    width:100%;
    text-align:center;

}

.process-number{

    margin:0 auto 22px;

}

.process-icon{

    margin:0 auto 18px;

}

.process-card p{

    max-width:75%;

}

.process-btn{

    width:100%;
    justify-content:center;

}

}



/*=====================================
REAL RESULTS
======================================*/

.results-section{
    padding:100px 0;
    background:#F8F6F2;
    overflow:hidden;
}

.results-heading{
    margin:0 auto 30px;
}

.results-eyebrow{
    display:inline-block;
    color:var(--primary);
    font-size:14px;
    letter-spacing:2px;
    font-weight:600;
    text-transform:uppercase;
    position:relative;
    margin-bottom:10px;
}

.results-eyebrow::after{
    content:"";
    display:block;
    width:35px;
    height:2px;
    background:var(--primary);
    margin:10px 0px;
}

.results-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    color:var(--black);
    line-height:48px;
    font-weight:500;
    margin-bottom:0px !important;
}

.results-desc{
    font-size:16px;
    line-height:1.8;
    color:var(--black);
    opacity:.75;
}

/*=====================================
SLIDER
======================================*/

.results-slider{
    position:relative;
    overflow:hidden;
}

.results-track{
    display:flex;
    transition:transform .55s ease;
    width: 33.33%;
}

.results-slide{
    width: 25%;
    min-width:100%;
    flex-shrink:0;
}

.results-card{
    display:flex;
    gap:10px;
    align-items:center;
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 18px 45px rgba(0,0,0,.08);
}

@media (max-width:767px){
    .results-track{
            width: 100%;
    }    
}


/*=====================================
IMAGES
======================================*/

.results-images{
    width:50%;
    display:flex;
}

.results-image{
    width:50%;
    position:relative;
    overflow:hidden;
}

.results-image img{
    width: 100%;
    height: 290px;
    display: block;
    object-fit: cover;
    transition: .4s;
}


.results-label{
    position:absolute;
    top:18px;
    left:18px;
    padding:7px 16px;
    border-radius:40px;
    font-size:12px;
    letter-spacing:1px;
    font-weight:700;
    color:#fff;
    z-index:5;
}

.results-label.before{
    background:#d9534f;
}

.results-label.after{
    background:#2eaf55;
}

/*=====================================
CONTENT
======================================*/

.results-content{
    width:48%;
    padding:15px 7px;
}

.results-stars{
    color: #F2B01E;
    font-size: 15px;
    letter-spacing: 2px;
    margin-bottom: 7px;
}

.results-review{
    font-size: 14px;
    line-height: 18px;
    color: var(--black);
    margin-bottom: 7px;
}

.results-content h4{
    font-size: 16px;
    line-height: 18px;
    color: var(--black);
    margin-bottom: 7px;
}
/*=====================================
CLIENT
======================================*/

.results-client{
    display:flex;
    align-items:center;
    gap:16px;
}

.client-avatar{
    width:65px;
    height:65px;
    border-radius:50%;
    overflow:hidden;
    flex-shrink:0;
}

.client-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.client-info h4{
    font-size:20px;
    margin:0 0 6px;
    color:var(--black);
    font-family:'Cormorant Garamond',serif;
    font-weight:600;
}

.client-info span{
    font-size:14px;
    color:#777;
}

/*=====================================
SLIDER ARROWS
======================================*/

.results-prev,
.results-next{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:52px;
    height:52px;
    border:none;
    border-radius:50%;
    background:#fff;
    color:var(--primary);
    font-size:22px;
    cursor:pointer;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    transition:var(--transition);
    z-index:20;
}

.results-prev{
    left:-20px;
}

.results-next{
    right:-20px;
}

.results-prev:hover,
.results-next:hover{

    background:var(--primary);
    color:#fff;
    transform:translateY(-50%) scale(1.08);

}

/*=====================================
DOTS
======================================*/

.results-dots{

    display:flex;
    justify-content:center;
    align-items:center;
    gap:12px;
    margin-top:35px;

}

.results-dot{

    width:12px;
    height:12px;
    border-radius:50%;
    border:none;
    background:#d8d8d8;
    cursor:pointer;
    transition:var(--transition);

}

.results-dot.active{

    width:34px;
    border-radius:50px;
    background:var(--primary);

}

.results-dot:hover{

    background:var(--primary);

}

/*=====================================
HOVER EFFECTS
======================================*/

.results-card{

    transition:.35s ease;

}

/*.results-card:hover{*/

/*    transform:translateY(-8px);*/
/*    box-shadow:0 22px 55px rgba(0,0,0,.12);*/

/*}*/

/*.results-card:hover .results-image img{*/

/*    transform:scale(1.08);*/

/*}*/

.client-avatar{

    transition:.35s ease;

}

/*.results-card:hover .client-avatar{*/

/*    transform:scale(1.08);*/

/*}*/

.results-stars{

    transition:.35s;

}

.results-card:hover .results-stars{

    letter-spacing:4px;

}

/*=====================================
TABLET
======================================*/

@media(max-width:992px){

.results-section{

    padding:80px 0;

}

.results-title{

    font-size:46px;

}

.results-card{

    flex-direction:column;

}

.results-images{

    width:100%;

}

.results-content{

    width:100%;
    padding:35px;

}

.results-review{

    font-size:16px;

}

.results-prev{

    left:10px;

}

.results-next{

    right:10px;

}

}

/*=====================================
MOBILE
======================================*/

@media(max-width:767px){

.results-section{

    padding:70px 0;

}

.results-heading{

    margin-bottom:45px;

}

.results-title{

    font-size:36px;

}

.results-desc{

    font-size:15px;

}

.results-images{

    flex-direction:column;

}

.results-image{

    width:100%;
    height:260px;

}

.results-content{

    padding:28px;

}

.results-review{

    font-size:15px;
    line-height:1.8;

}

.results-client{

    gap:14px;

}

.client-avatar{

    width:55px;
    height:55px;

}

.client-info h4{

    font-size:18px;

}

.client-info span{

    font-size:13px;

}

.results-prev,
.results-next{

    width:42px;
    height:42px;
    font-size:18px;

}

.results-prev{

    left:8px;

}

.results-next{

    right:8px;

}

.results-dot{

    width:10px;
    height:10px;

}

.results-dot.active{

    width:28px;

}

}

/*=====================================
SMALL MOBILE
======================================*/

@media(max-width:480px){

.results-title{

    font-size:32px;

}

.results-content{

    padding:22px;

}

.results-review{

    font-size:14px;

}

.results-stars{

    font-size:18px;

}

.client-info h4{

    font-size:17px;

}

}

/*=====================================
READY TO BREATHE CLEANER AIR
======================================*/

.breathe-section{
    padding:100px 0;
    background:#F8F6F2;
    background-size: cover;
    background-repeat: no-repeat;
}

.breathe-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:70px;
}

/*=====================================
LEFT SIDE
======================================*/

.breathe-left{
    width:46%;
}

.breathe-eyebrow{
    display:inline-block;
    position:relative;
    color:var(--primary);
    font-size:14px;
    font-weight:600;
    letter-spacing:2px;
    text-transform:uppercase;
    margin-bottom:25px;
}

.breathe-eyebrow::after{
    content:"";
    display:block;
    width:35px;
    height:2px;
    background:var(--primary);
    margin-top:10px;
}

.breathe-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    font-weight:500;
    color:var(--white);
    line-height:48px;
    margin-bottom:22px;
}

.breathe-text{
    color:var(--white);
    font-size:16px;
    line-height:1.9;
    margin-bottom:45px;
    opacity:.8;
}
.breathe-btn{
    margin: 0px;
    display: inline-flex;
    align-items: center;
    gap: 18px;
    padding: 16px 28px;
    border-radius: 6px;
    background: var(--primary);
    color: #fff;
    text-decoration: none;
    transition: var(--transition);
    font-weight: 600;

}

.breathe-btn:hover{

    background:var(--primary-dark);

}

/*=====================================
CARD HOVER
======================================*/

.breathe-card{
    transition:var(--transition);
}

.breathe-card:hover{
    transform:translateY(-8px);
    box-shadow:0 30px 70px rgba(0,0,0,.12);
}

/*=====================================
TABLET
======================================*/

@media(max-width:991px){

.breathe-section{
    padding:80px 0;
}

.breathe-wrapper{
    flex-direction:column;
    gap:50px;
}

.breathe-left,
.breathe-right{
    width:100%;
}

.breathe-title{
    font-size:48px;
}

.breathe-card{
    max-width:100%;
}

.feature-content h4{
    font-size:24px;
}

}

/*=====================================
MOBILE
======================================*/

@media(max-width:767px){

.breathe-section{
    padding:70px 0;
}

.breathe-title{
    font-size:38px;
}

.breathe-text{
    font-size:15px;
}

.breathe-card{
    padding:30px 25px;
}

.breathe-card h3{
    font-size:32px;
}

.quote-icon{
    width:55px;
    height:55px;
    font-size:28px;
}




}

/*=====================================
SMALL MOBILE
======================================*/

@media(max-width:480px){

.breathe-section{
    padding:60px 0;
}

.breathe-title{
    font-size:32px;
}

.breathe-text{
    font-size:14px;
}



}

/*=====================================
LARGE DESKTOP
======================================*/

@media(min-width:1400px){

.breathe-wrapper{
    gap:100px;
}

.breathe-title{
    font-size:64px;
}

.breathe-card{
    max-width:600px;
}

}


/*=====================================
NADCA APPROVED SECTION
======================================*/

/*.nadca-section{*/
/*    padding:100px 0;*/
/*    background-size:cover;*/
/*    background-position:center right;*/
/*    background-repeat:no-repeat;*/
/*    position:relative;*/
/*}*/

.nadca-section{
    position: relative;
    overflow: hidden;
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    padding:170px 0;
}

/*.nadca-section::before{*/
/*    content:"";*/
/*    position:absolute;*/
/*    inset:0;*/
/*   background:linear-gradient(*/
/*    90deg,*/
/*    rgba(12,18,24,.35) 0%,*/
/*    rgba(12,18,24,.25) 35%,*/
/*    rgba(12,18,24,.15) 65%,*/
/*    rgba(12,18,24,.05) 100%*/
/*);*/
/*    z-index:1;*/
/*}*/
.nadca-section .container{
    position:relative;
    z-index:2;
}

.nadca-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
}

/*=====================================
LEFT SIDE
======================================*/

.nadca-left{
    width:44%;
    padding-left: 70px;
}

.nadca-eyebrow{
    display:inline-block;
    position:relative;
    color:var(--primary);
    font-size:15px;
    font-weight:600;
    letter-spacing:3px;
    text-transform:uppercase;
    margin-bottom:28px;
}

.nadca-eyebrow::after{
    content:"";
    display:block;
    width:35px;
    height:2px;
    background:var(--primary);
    margin-top:10px;
}

.nadca-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    font-weight:500;
    color:var(--black);
    margin-bottom:20px;
}

.nadca-text{
    font-size:16px;
    line-height:22px;
    color:var(--black);
    opacity:.82;
    max-width:620px;
    margin-bottom:50px;
    max-width: 75%;
}

/*=====================================
FEATURE GRID
======================================*/

.nadca-features{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px 15px;

}

.nadca-feature{
    padding: 0px;
    display:flex;
    align-items:flex-start;
    gap:15px;
}

.nadca-icon2{
    width:40px;
    height:50px;
    min-width:50px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(197,139,71,.10);
    border:1px solid rgba(197,139,71,.20);
    border-radius:50%;
    font-size:20px;
}

.nadca-content h4{
    font-size: 14px;
    font-family: 'Jost', sans-serif color:var(--black);
    margin: 0px;
    font-weight: 500;
}

.nadca-content p{
    font-size:12px;
    line-height:1.8;
    color:var(--black);
    opacity:.78;
    margin:0;

}

/*=====================================
RIGHT SIDE
======================================*/

.nadca-right{

    width:44%;
    display:flex;
    justify-content:flex-end;

}

/*=====================================
CARD
======================================*/

.nadca-card{

    width:100%;
    max-width:560px;

    background:#ECE3D6;

    backdrop-filter:blur(8px);

    border:1px solid rgba(255,255,255,.5);

    border-radius:24px;

    padding:30px;

    box-shadow:0 25px 60px rgba(0,0,0,.10);

}

/*=====================================
LOGO
======================================*/

.nadca-logo{
display: flex;
    justify-content: center;
    margin-bottom:20px;

}

.nadca-logo img{

    max-width:250px;
    width:100%;
    height:auto;

}

/*=====================================
DIVIDER
======================================*/

.nadca-divider{
    width:120px;
    height:2px;
    background:var(--primary);
    margin:15px auto;

}

/*=====================================
CARD TEXT
======================================*/

.nadca-card-text{
    padding: 0px 30px;
    text-align:center;
    font-size:16px !important;
    line-height:22px;
    color:var(--black);
    margin-bottom:45px;

}

/*=====================================
BOTTOM BENEFITS
======================================*/

.nadca-benefits{

    display:grid;
    grid-template-columns:repeat(4,1fr);

    border:1px solid #ececec;

    border-radius:18px;

    overflow:hidden;

}

.benefit-item{

    text-align:center;

    padding:20px 12px;

    border-right:1px solid #ececec;

}

.benefit-item:last-child{

    border-right:none;

}

.benefit-icon{

    font-size:32px;

    color:var(--primary);

    margin-bottom:16px;

}

.benefit-item h5{
    font-family:'Cormorant Garamond',serif;
    font-size:14px;
    margin-bottom:4px;
    color:var(--black);
    font-weight: 400;
}

.benefit-item span{
    display:block;
    font-size:12px;
    color:var(--black);
    line-height:1.6;

}


/*=====================================
CARD HOVER
======================================*/

.nadca-card{
    transition:var(--transition);
}

.nadca-card:hover{
    transform:translateY(-10px);
    box-shadow:0 35px 80px rgba(0,0,0,.15);
}

/*=====================================
FEATURE HOVER
======================================*/

.nadca-feature{
    transition:var(--transition);
}

.nadca-icon{
    transition:var(--transition);
}

.nadca-feature:hover{
    transform:translateX(8px);
}

.nadca-feature:hover .nadca-icon{
    background:var(--primary);
    color:#fff;
    transform:rotate(360deg);
}

/*=====================================
BENEFITS HOVER
======================================*/

.benefit-item{
    transition:var(--transition);
}

.benefit-icon{
    transition:var(--transition);
}

.benefit-item:hover{
    background:#faf6f1;
}

.benefit-item:hover .benefit-icon{
    transform:translateY(-5px) scale(1.1);
}

.benefit-item:hover h5{
    color:var(--primary);
}

/*=====================================
LOGO
======================================*/

.nadca-logo img{
    transition:.4s ease;
}

.nadca-card:hover .nadca-logo img{
    transform:scale(1.03);
}

/*=====================================
TABLET
======================================*/

@media (max-width:991px){

.nadca-section{
    padding:80px 0;
}

.nadca-wrapper{
    flex-direction:column;
}

.nadca-left,
.nadca-right{
    width:100%;
}

.nadca-title{
    font-size:44px;
}

.nadca-text{
    max-width:100%;
}

.nadca-card{
    max-width:100%;
}

.nadca-features{
    grid-template-columns:repeat(2,1fr);
    gap:30px;
}

.benefit-item{
    padding:24px 15px;
}

}

/*=====================================
MOBILE
======================================*/

@media (max-width:767px){

.nadca-left{
    padding: 0px !important;
}
.nadca-section{
    padding:70px 0;
}

.nadca-wrapper{
    gap:45px;
}

.nadca-title{
    font-size:40px;
    line-height:1.1;
}

.nadca-text{
    font-size:15px;
    margin-bottom:35px;
}

.nadca-features{
    grid-template-columns:1fr;
    gap:25px;
}

.nadca-feature{
    gap:16px;
}

.nadca-icon{
    width:55px;
    height:55px;
    min-width:55px;
    font-size:24px;
}

.nadca-content h4{
    font-size:22px;
}

.nadca-content p{
    font-size:14px;
}

.nadca-card{
    padding:30px 22px;
}

.nadca-logo img{
    max-width:200px;
}

.nadca-card-text{
    font-size:15px;
    margin-bottom:30px;
}

.nadca-benefits{
    grid-template-columns:repeat(2,1fr);
}

.benefit-item{
    border-right:1px solid #ececec;
    border-bottom:1px solid #ececec;
}

.benefit-item:nth-child(2){
    border-right:none;
}

.benefit-item:nth-child(3){
    border-bottom:none;
}

.benefit-item:nth-child(4){
    border-right:none;
    border-bottom:none;
}

.benefit-icon{
    font-size:28px;
}

.benefit-item h5{
    font-size:18px;
}

.benefit-item span{
    font-size:13px;
}

}

/*=====================================
SMALL MOBILE
======================================*/

@media (max-width:480px){

.nadca-section{
    padding:60px 0;
}

.nadca-title{
    font-size:34px;
}

.nadca-eyebrow{
    font-size:13px;
}

.nadca-card{
    padding:22px 18px;
    border-radius:18px;
}

.nadca-logo img{
    max-width:170px;
}

.nadca-card-text{
    font-size:14px;
}

.nadca-benefits{
    grid-template-columns:1fr;
}

.benefit-item{
    border-right:none;
    border-bottom:1px solid #ececec;
}

.benefit-item:last-child{
    border-bottom:none;
}

.benefit-icon{
    font-size:26px;
}

.benefit-item h5{
    font-size:17px;
}

.benefit-item span{
    font-size:13px;
}

.nadca-icon{
    width:50px;
    height:50px;
    min-width:50px;
    font-size:22px;
}

.nadca-content h4{
    font-size:20px;
}

}

/*=====================================
LARGE DESKTOP
======================================*/

@media (min-width:1400px){

.nadca-wrapper{
    /*gap:100px;*/
}

.nadca-title{
    font-size:44px;
}

.nadca-card{
    max-width:600px;
}

.nadca-logo img{
    max-width:220px;
}

}




/*=====================================
SERVICE AREAS SECTION
======================================*/

.areas-section{
    position:relative;
    padding:100px 0;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    overflow:hidden;
}

.areas-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:70px;
}

/*=====================================
LEFT SIDE
======================================*/

.areas-left{
    width:45%;
    padding-top:40px;
}

.areas-eyebrow{
    display:inline-block;
    color:var(--primary);
    font-size:15px;
    font-weight:600;
    letter-spacing:3px;
    text-transform:uppercase;
    position:relative;
    margin-bottom:30px;
}

.areas-eyebrow::after{
    content:"";
    display:block;
    width:35px;
    height:2px;
    background:var(--primary);
    margin-top:10px;
}

.areas-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    font-weight:500;
    color:var(--black);
    margin-bottom:20px;

}

.areas-text{
    font-size:16px;
    line-height:1.9;
    color:var(--black);
    margin-bottom:20px;
}

.areas-line{
    width:60px;
    height:2px;
    background:var(--primary);
    margin-bottom:20px;
}

/*=====================================
FEATURES
======================================*/

.areas-feature{

    display:flex;
    align-items:flex-start;
    gap:18px;
    margin-bottom:28px;

}

.areas-icon{
    width:50px;
    height:50px;
    min-width:50px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#DCC6B2;
    border:1px solid rgba(197,139,71,.15);
    border-radius:18px;
    font-size:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.areas-feature-content h4{
    font-size: 18px;
    font-family: 'Cormorant Garamond', serif;
    color: var(--black);
    margin-bottom: 0px;
    line-height: 24px;
    font-weight: 500;
}

.areas-feature-content p{
    font-size:12px;
    line-height:1.7;
    color:var(--black);
    opacity:.75;
    margin-bottom: 0px;
}

/*=====================================
RIGHT SIDE
======================================*/

.areas-right{
    width:60%;
}

/*=====================================
MAP CARD
======================================*/

.areas-map-card{

    display:flex;
    background:rgba(255,255,255,.92);
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,.08);
    margin-bottom:40px;

}

/*=====================================
LOCATION LIST
======================================*/

.areas-list{

    width:36%;
    padding:40px;

}

.areas-list h3{
    font-family:'Cormorant Garamond',serif;
    font-size:34px;
    font-weight: 500;
    margin-bottom:20px;
    color:var(--black);
}
.areas-list ul{
    list-style:none;
    margin:0;
    padding:0;
}
.areas-list li{
        display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    cursor: pointer;
    font-size: 11px;
    color: var(--black);
    transition: var(--transition);
    line-height: 14px;
}

.areas-list li:hover{
    color:var(--primary);
    transform:translateX(4px);
}

/*=====================================
BUTTON
======================================*/

.areas-btn{
        display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
    padding: 10px 20px;
    background: var(--primary);
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: var(--transition);
    font-size: 14px;
    margin-left: 0px;
    margin-right: 0px;
}

.areas-btn span{
    transition:var(--transition);
}
.areas-btn:hover{
    background:var(--primary-dark);
}
.areas-btn:hover span{
    transform:translateX(5px);
}

/*=====================================
MAP
======================================*/

.areas-map{

    width:64%;
    min-height:520px;

}

.areas-map iframe{

    width:100%;
    height:100%;
    border:none;
    display:block;

}


/*=====================================
SERVICE VAN CARD
======================================*/
.areas-van-card{
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
}


.areas-van-card{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:40px;
    background:rgba(255,255,255,.94);
    border-radius:24px;
    padding:50px 15px;
    margin-bottom:35px;
    box-shadow:0 20px 50px rgba(0,0,0,.08);
}

.van-left{
    display:flex;
    align-items:center;
    gap:25px;
    flex:1;
}
.van-icon{
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #0e2237;
    color: var(--primary);
    font-size: 22px;
    flex-shrink: 0;
}

.van-content span{
    display:block;
    color:var(--primary);
    font-size:12px;
    font-weight:600;
    letter-spacing:2px;
    margin-bottom:12px;
}

.van-content h3{
    font-family:'Cormorant Garamond',serif;
    font-size:24px;
    line-height:1;
    color:var(--black);
    margin-bottom:15px;
}
.van-content p{
    color:var(--black);
    opacity:.75;
    line-height:1.8;
    font-size:12px;
    max-width: 55%;
}
.van-image{

    width:42%;

}

.van-image img{

    width:100%;

    display:block;

}

/*=====================================
CONTACT STRIP
======================================*/

.areas-contact{

    display:flex;
    align-items:center;
    justify-content:space-between;

    background:#e8d5c4;

    border-radius:18px;

    padding:28px 35px;

    box-shadow:0 20px 45px rgba(0,0,0,.08);

}

.contact-box{

    display:flex;
    align-items:center;
    gap:20px;

    flex:1;

}

.contact-divider{

    width:1px;

    height:70px;

    background:#e8e8e8;

    margin:0 30px;

}

.contact-icon{
width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    font-size: 20px;
    flex-shrink: 0;
}

.contact-box span{
    display:block;
    color:#777;
    font-size:12px;
    line-height: 22px;
}

.contact-box h4{
    font-size:20px;
    line-height:24px;
    font-family:'Cormorant Garamond',serif;
    color:var(--black);
    margin-bottom:0px;
}

.contact-box p{
    font-size:12px;
    color:#666;
    margin-bottom: 0px;
}

/*=====================================
HOVER EFFECTS
======================================*/

.areas-feature,
.areas-icon,
.benefit-item,
.contact-box,
.areas-van-card,
.areas-map-card{

    transition:var(--transition);

}

.areas-feature:hover{

    transform:translateX(8px);

}

.areas-feature:hover .areas-icon{

    background:var(--primary);

    color:#fff;

    transform:rotate(360deg);

}

.areas-map-card:hover,
.areas-van-card:hover{

    transform:translateY(-8px);

    box-shadow:0 30px 70px rgba(0,0,0,.14);

}

.contact-box:hover .contact-icon{

    transform:scale(1.08);

}

/*=====================================
TABLET
======================================*/

@media(max-width:991px){

.areas-wrapper{
    flex-direction:column;
}

.areas-left,
.areas-right{

    width:100%;

}

.areas-title{
    font-size:44px;
}

.areas-map-card{

    flex-direction:column;

}

.areas-list,
.areas-map{

    width:100%;

}

.areas-map{

    min-height:420px;

}

.areas-van-card{

    flex-direction:column;

    text-align:center;

}

.van-left{

    flex-direction:column;

}

.van-image{

    width:100%;

}

.areas-contact{

    flex-direction:column;

    gap:30px;

}

.contact-divider{

    width:100%;

    height:1px;

    margin:0;

}

.contact-box{

    width:100%;

}

}

/*=====================================
MOBILE
======================================*/

@media(max-width:767px){
    
    .van-left{
        flex-direction:row;
        gap: 10px;
        align-items: flex-start;
        flex-direction: column;
    }
    .van-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #0e2237;
        color: var(--primary);
        font-size: 18px;
        flex-shrink: 0;
    }
    .van-content span {
    display: block;
    color: var(--primary);
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    margin-bottom: 5px;
}
    .van-content h3 {
        font-size: 18px !important;
        margin-bottom: 5px;
    }
    .van-content p{
        font-size: 11px;
    }
.areas-van-card{
    text-align: left;
    padding: 20px 10px;
}
.areas-section{
    padding:70px 0;
}

.areas-title{
    font-size:40px;
}

.areas-text{

    font-size:15px;

}

.areas-feature{

    gap:15px;

}

.areas-icon{

    width:55px;
    height:55px;
    min-width:55px;

    font-size:22px;

}

.areas-feature-content h4{
    font-size:18px;
}
.areas-feature-content p{
    font-size:14px;
}

.areas-list{

    padding:25px;

}

.areas-list h3{

    font-size:34px;

}

.areas-list li{

    font-size:15px;

}

.areas-btn{

    width:100%;

    justify-content:center;

}



.contact-box{

    flex-direction:column;

    text-align:center;

}

.contact-box h4{
    font-size:17px;
}

.contact-icon{

    width:60px;

    height:60px;

    font-size:24px;

}

}

/*=====================================
SMALL MOBILE
======================================*/

@media(max-width:480px){

.areas-title{
    font-size:34px;
}

.van-content h3{

    font-size:24px;

}

.areas-map{

    min-height:150px;

}

.contact-box h4{
    font-size:17px;
}

.contact-box p{
    font-size:14px;
}

.contact-icon{

    width:55px;

    height:55px;

    font-size:22px;

}

.areas-map-card,
.areas-van-card,
.areas-contact{

    border-radius:18px;

}
.areas-van-card{
    height: 200px;
}

}

/*=====================================
LARGE DESKTOP
======================================*/

@media(min-width:1400px){

.areas-wrapper{
    gap:70px;
}

.areas-title{
    font-size:44px;
    line-height: 48px;
}

.areas-map{

    min-height:560px;

}

.van-content h3{
    font-size:24px;
}

.contact-box h4{
    font-size:20px;
}

}




/*=====================================
PRICING SECTION
======================================*/

.pricing-section{

    position:relative;
    padding:80px 0 80px;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    overflow:hidden;

}

.pricing-section::before{
    position:absolute;
    inset:0;
    background:linear-gradient(
        180deg,
        rgba(255,255,255,.90),
        rgba(255,255,255,.82)
    );
    z-index:1;
}

.pricing-section .container{

    position:relative;

    z-index:2;

}

/*=====================================
SECTION HEADING
======================================*/

.pricing-heading{

    max-width:760px;

    margin:0 auto 70px;

    text-align:center;

}

.pricing-eyebrow{
    display:inline-block;
    color:var(--primary);
    font-size:15px;
    font-weight:600;
    letter-spacing:3px;
    text-transform:uppercase;
    position:relative;
    margin-bottom:20px;
}

.pricing-eyebrow::after{
    content:"";
    display:block;
    width:80px;
    height:2px;
    background:var(--primary);
    margin:12px auto 0;
}
.pricing-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    color:var(--black);
    margin-bottom:12px;
}

.pricing-subtitle{
    font-size:20px;
    font-weight:400;
    color:var(--black);
    margin-bottom:15px;
}
.pricing-subtitle span{
    color:var(--primary);
}
.pricing-heading p{
    font-size:16px;
    color:var(--black);
    line-height:1.8;
}

/*=====================================
PRICING CARDS
======================================*/

.pricing-cards{

    display:flex;

    justify-content:center;

    align-items:flex-start;

    gap:28px;

    margin-bottom:70px;

}

.pricing-card{

    flex:1;

    position:relative;

    background:rgba(255,255,255,.94);

    border:1px solid rgba(197,139,71,.18);

    border-radius:28px;

    padding:36px;

    box-shadow:0 20px 55px rgba(0,0,0,.08);

    transition:var(--transition);

}

.pricing-card:hover{

    transform:translateY(-10px);

    box-shadow:0 28px 70px rgba(0,0,0,.14);

}

.featured-card{

    transform:scale(1.05);

    z-index:2;

}

.featured-card:hover{

    transform:scale(1.05) translateY(-10px);

}

/*=====================================
POPULAR BADGE
======================================*/

.popular-badge{

    position:absolute;

    left:50%;

    top:-15px;

    transform:translateX(-50%);

    background:var(--primary);

    color:#fff;

    padding:8px 20px;

    border-radius:30px;

    font-size:13px;

    font-weight:600;

    letter-spacing:.5px;

}

/*=====================================
CARD TOP
======================================*/

.pricing-top{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:20px;
}

.pricing-icon{
    width:50px;
    height:50px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#fff8f0;
    color:var(--primary);
    font-size:24px;
    border:1px solid rgba(197,139,71,.18);
    flex-shrink:0;
}
.pricing-top h3{
    font-family:'Cormorant Garamond',serif;
    font-size:18px;
    color:var(--black);
    margin-bottom:0px;
    line-height: 24px;
}

.pricing-top span{
    color:var(--primary);
    font-size:12px;
    font-weight:500;
}
/*=====================================
DIVIDER
======================================*/
.pricing-divider{
    width:100%;
    height:1px;
    background:rgba(197,139,71,.35);
    margin:15px 0;
}

/*=====================================
PRICE
======================================*/

.pricing-wraper{
    display:flex;
    flex-direction: row;
    gap: 10px;
    justify-content: space-between;
}

.pricing-price small{
    display:block;
    color:var(--black);
    font-size:12px;
    margin-bottom:0px;
}
.pricing-price h2{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    color:var(--black);
    margin-bottom:0px;
}
.custom-price{
    font-size:44px !important;
}

.pricing-price h5{
    font-size:14px;
    color:var(--primary);
    font-weight:700;
    margin-bottom:30px;
}

.pricing-price h5 span{
    color:var(--black);
    font-weight:500;
}


/*=====================================
PRICING FEATURES
======================================*/

.pricing-features{
    display:flex;
    flex-direction:column;
    gap:10px;
    margin-bottom:10px;
}
.pricing-features div{
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--black);
    font-size:12px;
    line-height:1.6;
}
.tick-icon{
    color: var(--primary);
}

/*=====================================
BUTTONS
======================================*/

.pricing-btn{
    width:100%;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:18px;
    padding:12px 24px;
    background:var(--primary);
    color:#fff;
    text-decoration:none;
    border-radius:12px;
    font-size:17px;
    font-weight:600;
    transition:var(--transition);
}
.pricing-btn span{
    transition:var(--transition);
}

.pricing-btn:hover{

    background:var(--primary-dark);

}

.pricing-btn:hover span{

    transform:translateX(6px);

}

.dark-btn{

    background:#081b2e;

}

.dark-btn:hover{

    background:#0f2c48;

}

/*=====================================
SUMMER OFFER
======================================*/

.offer-card{
    background-size: cover;
    background-repeat: no-repeat;
    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:50px;

    padding:55px;

    background:rgba(255,255,255,.93);

    border-radius:30px;

    overflow:hidden;

    position:relative;

    box-shadow:0 25px 70px rgba(0,0,0,.08);

    margin-bottom:45px;

}

.offer-left{
    width:52%;
    display:flex;
    gap:22px;
}

.offer-icon{
    width:50px;
    height:50px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:#fff7ed;
    border:1px solid rgba(197,139,71,.2);
    color:var(--primary);
    font-size:28px;
    flex-shrink:0;
}
.offer-content span{
    display:block;
    color:var(--primary);
    font-size:16px;
    letter-spacing:2px;
    font-weight:600;
    margin-bottom:5px;
}

.offer-content h2{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    color:var(--black);
    margin-bottom:5px;
}
.offer-content p{
    font-size:16px;
    color:var(--black);
    line-height:1.8;
    margin-bottom:5px;
}
.offer-content ul{
    list-style:none;
    padding:0;
    margin:0 0 0px;
}

.offer-content li{
    margin-bottom:6px;
    color:var(--black);
    font-size:12px;
}

/*=====================================
OFFER PRICE BOX
======================================*/

.offer-price{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:16px 25px;
    background:#fffaf5;
    border:2px solid var(--primary);
    border-radius:14px;
}

.offer-price strong{
    font-size:14px;
    color:var(--black);
}

.offer-price del{
    font-size:30px;
    font-family:'Cormorant Garamond',serif;
    color:var(--black);
}

.offer-price span{
    font-size:28px;
    color:var(--primary);
    margin:0;
}

.offer-price b{
    font-size:30px;
    font-family:'Cormorant Garamond',serif;
    color:var(--primary);
}

.offer-price small{
    color:var(--black);
    font-size:14px;
}

/*=====================================
RIGHT IMAGE
======================================*/

.offer-right{

    width:48%;

    position:relative;

}

.offer-right img{

    width:100%;

    display:block;

}

.offer-circle{
    position:absolute;
    left:-45px;
    width:155px;
    height:155px;
    border-radius:50%;
    background:#081b2e;
    border:5px solid var(--primary);
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:18px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

.offer-circle span{
    color:#fff;
    font-size:15px;
    line-height:1.7;
}

/*=====================================
BOTTOM STRIP
======================================*/

.pricing-bottom{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-radius: 18px;
    padding: 30px 35px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, .08);
    width: 75%;
    position: absolute;
    bottom: -72px;
    right: 50px;
}

.bottom-item{
    display:flex;
    justify-content: center;
    align-items:center;
    gap:18px;
    flex:1;
}
.bottom-item:not(:last-child){
    border-right:1px solid rgba(197,139,71,.18);
}
.bottom-icon{
    font-size:34px;
    color:var(--primary);
}

.bottom-item h4{
    font-size: 15px;
    color: var(--black);
    margin-bottom: 0px;
    line-height: 22px;
}

.bottom-item p{
    font-size:13px;
    color:var(--black);
    margin-bottom: 0px;
}

/*=====================================
HOVER EFFECTS
======================================*/

.offer-card,
.pricing-bottom,
.bottom-item,
.offer-icon,
.pricing-icon{

    transition:var(--transition);

}

.offer-card:hover{

    transform:translateY(-8px);

    box-shadow:0 35px 80px rgba(0,0,0,.12);

}

.bottom-item:hover .bottom-icon{

    transform:scale(1.2);

}

.pricing-card:hover .pricing-icon{

    transform:rotate(12deg) scale(1.08);

}

/*=====================================
TABLET
======================================*/

@media(max-width:991px){

.pricing-cards{

    flex-wrap:wrap;

}

.pricing-card{

    flex:0 0 calc(50% - 14px);

}

.featured-card{

    transform:none;

}

.featured-card:hover{

    transform:translateY(-10px);

}

.offer-card{

    flex-direction:column;

    padding:40px;

}

.offer-left,
.offer-right{

    width:100%;

}

.offer-right{

    text-align:center;

}

.offer-circle{

    left:50%;

    transform:translateX(-50%);

    bottom:20px;

}

.pricing-bottom{

    flex-wrap:wrap;

    gap:25px;

}

.bottom-item{

    flex:0 0 calc(50% - 15px);

    border:none !important;

}

}

/*=====================================
MOBILE
======================================*/

@media(max-width:767px){

.pricing-section{

    padding:70px 0;

}

.pricing-title{

    font-size:46px;

}

.pricing-subtitle{

    font-size:24px;

}

.pricing-heading p{

    font-size:16px;

}

.pricing-cards{

    flex-direction:column;

}

.pricing-card{

    width:100%;

}

.offer-left{

    flex-direction:column;

}

.offer-content h2{

    font-size:40px;

}

.offer-price{

    flex-wrap:wrap;

    justify-content:center;

    text-align:center;

}

.offer-price del{

    font-size:34px;

}

.offer-price b{

    font-size:38px;

}

.offer-circle{

    position:relative;

    left:auto;

    bottom:auto;

    transform:none;

    margin:25px auto 0;

}

.pricing-bottom{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-radius: 18px;
    padding: 30px 35px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, .08);
    width: 100%;
    position: relative;
    right: 0px;
    bottom: 0px;
}

.bottom-item{

    width:100%;

    justify-content:center;

    text-align:center;

}

}

/*=====================================
SMALL MOBILE
======================================*/

@media(max-width:480px){

.pricing-title{

    font-size:36px;

}

.pricing-top{

    flex-direction:column;

    text-align:center;

}

.pricing-price h2{

    font-size:58px;

}

.custom-price{

    font-size:44px !important;

}

.offer-content h2{

    font-size:32px;

}

.offer-price{

    padding:14px;

}

.offer-price strong,
.offer-price b,
.offer-price del{

    width:100%;

    text-align:center;

}

.bottom-item{

    flex-direction:column;

}

}



/*=====================================
REQUEST A QUOTE SECTION
CSS PART 1
======================================*/

.quote-section{
    position:relative;
    padding:100px 0;
    background-size:cover;
    background-position:center right;
    background-repeat:no-repeat;
}

.quote-section::before{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(255,255,255,.32);
}

.quote-section .container{
    position:relative;
    z-index:2;
}

/*=====================================
LAYOUT
======================================*/

.quote-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.quote-left{
    flex:0 0 40%;
}

.quote-right{
    flex:0 0 58%;
}

/*=====================================
LEFT CONTENT
======================================*/

.quote-eyebrow{
    display:inline-block;
    position:relative;
    font-size:15px;
    font-weight:600;
    letter-spacing:3px;
    color:var(--primary);
    text-transform:uppercase;
    margin-bottom:22px;
}

.quote-eyebrow::after{
    content:"";
    display:block;
    width:55px;
    height:2px;
    background:var(--primary);
    margin-top:14px;
}

.quote-title{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    line-height:48px;
    font-weight:600;
    color:var(--black);
    margin-bottom:20px;
}

.quote-text{
    max-width:500px;
    font-size:16px;
    line-height:1.8;
    color:var(--black);
    margin-bottom:20px;
}

.quote-line{
    width:65px;
    height:2px;
    background:var(--primary);
    margin-bottom:30px;
}

/*=====================================
FEATURE ITEMS
======================================*/

.quote-feature{
    display:flex;
    align-items:flex-start;
    gap:22px;
    margin-bottom:30px;
}

.quote-icon{
    width:50px;
    height:50px;
    flex-shrink:0;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:#F8F2EA;
    color:var(--primary);
    font-size:20px;
    transition:var(--transition);
}

.quote-feature:hover .quote-icon{
    transform:translateY(-5px);
    background:var(--primary);
    color:#fff;
}

.quote-feature h4{
    font-size: 18px;
    font-family: 'Cormorant Garamond', serif;
    color: var(--black);
    margin-bottom: 0px;
    line-height: 24px;
    font-weight: 500;
}

.quote-feature p{
    font-size: 12px;
    line-height: 1.7;
    color: var(--black);
    opacity: .75;
    margin-bottom: 0px;
}

/*=====================================
RIGHT CARD
======================================*/

.quote-card{
    background:#ECE3D6;
    border-radius:26px;
    padding:45px;
    box-shadow:0 20px 60px rgba(0,0,0,.08);
    border:1px solid rgba(197,139,71,.15);
}

/*=====================================
CARD HEADER
======================================*/

.quote-card-header{
    display:flex;
    align-items:flex-start;
    gap:25px;
    margin-bottom:45px;
}

.quote-card-icon{
    width:85px;
    height:85px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;
    background:#F8F2EA;

    color:var(--primary);
    font-size:42px;
    flex-shrink:0;
}

.quote-card-header h3{
    font-family:'Cormorant Garamond',serif;
    font-size:34px;
    font-weight:500;
    color:var(--black);
    margin-bottom:12px;
}

.quote-card-header p{
    font-size:16px;
    line-height:1.7;
    color:#555;
    margin:0;
}

/*=====================================
FORM LAYOUT
======================================*/

.quote-form{
    width:100%;
}

.quote-row{
    display:flex;
    gap:20px;
    margin-bottom:20px;
}

.quote-group{
    flex:1;
    display:flex;
    flex-direction:column;
}

.quote-group label{
    font-size:14px;
    font-weight:500;
    color:var(--black);
    margin-bottom:10px;
}

.quote-group label span{
    color:var(--primary);
}



/*=====================================
INPUTS
======================================*/

.quote-group input,
.quote-group select,
.quote-group textarea{
    width:100%;
    height:45px;
    padding:0 18px;
        border: 1.5px solid #7586964f;
    border-radius:12px;
    background:transparent;
    font-size:16px;
    font-family:'Jost',sans-serif;
    color:var(--black);
    transition:var(--transition);
    outline:none;
}

.quote-group textarea{
    height:80px;
    resize:vertical;
    padding:18px;
}

.quote-group input:focus,
.quote-group select:focus,
.quote-group textarea:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(197,139,71,.12);
}

.quote-group input::placeholder,
.quote-group textarea::placeholder{
    color:#999;
}

/*=====================================
SERVICES CHECKBOXES
======================================*/

.quote-services{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-top:10px;
}

.quote-check{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 12px;
    border:1px solid #e8e8e8;
    border-radius:12px;
    background:#fff;
    cursor:pointer;
    transition:var(--transition);
}

.quote-check:hover{
    border-color:var(--primary);
    background:#fcf7f1;
}

.quote-check input{
    width:18px;
    height:18px;
    accent-color:var(--primary);
    border-radius: 8px;
}

.quote-check span{
    font-size:12px;
    font-weight:500;
    color:var(--black);
}

/*=====================================
BUTTON
======================================*/

.quote-btn{
    width:100%;
    margin-top:30px;
    height:55px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:18px;
    border:none;
    border-radius:14px;
    background:var(--primary);
    color:#fff;
    font-size:20px;
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
}

.quote-btn:hover{
    background:var(--primary-dark);
    transform:translateY(-3px);
}

.quote-btn span{
    font-size:24px;
    transition:.3s;
}

.quote-btn:hover span{
    transform:translateX(6px);
}

/*=====================================
SECURITY TEXT
======================================*/

.quote-secure{
    margin-top:18px;
    text-align:center;
    font-size:15px;
    color:#666;
}

/*=====================================
NADCA CARD
======================================*/

.quote-nadca-card{
    margin-top:60px;
    background:#fff;
    border-radius:22px;
    padding:30px 15px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    box-shadow:0 15px 40px rgba(0,0,0,.06);
}

.nadca-item{
    display:flex;
    align-items:center;
    gap:10px;
}

.nadca-icon{
    width:64px;
    height:64px;
    border-radius:50%;
    background:#F8F2EA;
    color:var(--primary);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
}

.nadca-item h4{
    font-size: 18px;
    font-family: 'Cormorant Garamond', serif;
    color: var(--black);
    margin-bottom: 0px;
    line-height: 24px;
    font-weight: 500;
}

.nadca-item p{
    margin:0;
    font-size:12px;
    line-height:1.6;
    color:#555;
    margin-top: 5px;
}

.nadca-divider2{
    width:1px;
    height:80px;
    background:#ececec;
}

.nadca-logo2 img{
    max-width:100px;
    display:block;
}

.nadca-text2 p{
    font-size:12px;
    line-height:1.4;
    color:#444;
    margin:0;
}

/*=====================================
RESPONSIVE
======================================*/

@media (max-width:1024px){

    .quote-wrapper{
        flex-direction:column;
        gap:60px;
    }

    .quote-left,
    .quote-right{
        flex:0 0 100%;
        width:100%;
    }

    .quote-title{
        font-size:56px;
    }

    .quote-card{
        padding:35px;
    }

    .quote-row{
        flex-direction:column;
        gap:20px;
    }

    .quote-nadca-card{
        flex-wrap:wrap;
        justify-content:center;
        text-align:center;
    }

    .nadca-divider{
        display:none;
    }

}

@media (max-width:768px){

    .quote-section{
        padding:70px 0;
    }

    .quote-title{
        font-size:42px;
        line-height:1.1;
    }

    .quote-text{
        font-size:17px;
        line-height:1.7;
    }

    .quote-feature{
        gap:16px;
    }

    .quote-icon{
        width:56px;
        height:56px;
        font-size:26px;
    }

    .quote-feature h4{
        font-size:18px;
    }

    .quote-feature p{
        font-size:15px;
    }

    .quote-card{
        padding:25px;
        border-radius:18px;
    }

    .quote-card-header{
        flex-direction:column;
        align-items:flex-start;
        gap:18px;
    }

    .quote-card-icon{
        width:70px;
        height:70px;
        font-size:34px;
    }

    .quote-card-header h3{
        font-size:34px;
    }

    .quote-services{
        flex-direction:column;
    }

    .quote-check{
        width:100%;
    }

    .quote-btn{
        font-size:18px;
        height:58px;
    }

    .quote-nadca-card{
        padding:20px;
        flex-wrap: wrap;
        flex-direction: column;
        gap: 15px;
    }
    
    .nadca-divider2{
        display: none;    
    }

    .nadca-item{
        flex-direction:column;
        text-align:center;
    }

    .nadca-logo img{
        max-width:100px;
    }

    .nadca-text{
        text-align:center;
    }

}



/*=====================================
PRIVACY Page HERO
======================================*/

.privacy-hero{
    position:relative;
    padding:180px 0 110px;
    background-repeat:no-repeat;
    background-position:center center;
    background-size:cover;
    overflow:hidden;
}

.privacy-hero-overlay{
    position:absolute;
    inset:0;
     background: linear-gradient(10deg, rgba(255, 255, 255, .6) 0%, rgba(255, 255, 255, .12) 80%, rgba(255, 255, 255, .01) 100%);
}

.privacy-hero-content{
    position:relative;
    z-index:2;
    max-width:820px;
    margin:0 auto;
    text-align:center;
}

.privacy-hero-title{
    font-family:'Cormorant Garamond',serif;
    font-size:72px;
    font-weight:500;
    line-height:1.3;
    color:#142335;
    margin:0 0 22px;
}

.privacy-hero-divider{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:18px;
    margin-bottom:22px;
}

.privacy-line{
    width:110px;
    height:2px;
    background:var(--primary);
    opacity:.75;
}

.privacy-divider-icon{
    width:48px;
    height:48px;
    border:1px solid rgba(197,139,71,.25);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(255,255,255,.9);
    font-size:20px;
    color:var(--primary);
}

.privacy-hero-update{
    font-size:16px;
    font-weight:600;
    color:var(--primary);
    letter-spacing:.5px;
    margin-bottom:22px;
}

.privacy-hero-text{
    max-width:760px;
    margin:0 auto;
    font-size:18px;
    line-height:1.9;
    color:var(--black);
}

/*=====================================
RESPONSIVE Privacy Page Hero Section
======================================*/

@media(max-width:991px){

    .privacy-hero{
        padding:150px 0 90px;
    }

    .privacy-hero-title{
        font-size:54px;
    }

    .privacy-hero-text{
        font-size:17px;
    }

}

@media(max-width:767px){

    .privacy-hero{
        padding:120px 0 70px;
        background-position:center;
    }

    .privacy-hero-title{
        font-size:42px;
    }

    .privacy-line{
        width:60px;
    }

    .privacy-divider-icon{
        width:42px;
        height:42px;
        font-size:18px;
    }

    .privacy-hero-update{
        font-size:15px;
    }

    .privacy-hero-text{
        font-size:15px;
        line-height:1.8;
    }

}

@media(max-width:480px){

    .privacy-hero-title{
        font-size:34px;
    }

    .privacy-line{
        width:45px;
    }

    .privacy-hero-text{
        font-size:14px;
    }

}

/*=====================================
PRIVACY CONTENT SECTION
======================================*/

.privacy-content-section{
    padding:80px 0 100px;
    background:#f8f5f1;
}

.privacy-card{
    background:rgba(255,255,255,.92);
    backdrop-filter:blur(12px);
    border:1px solid rgba(197,139,71,.12);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 25px 70px rgba(0,0,0,.08);
}

/*=====================================
PRIVACY ROW
======================================*/

.privacy-row{
    display:flex;
    align-items:flex-start;
    gap:45px;
    padding:50px;
    border-bottom:1px solid rgba(0,0,0,.08);
    transition:var(--transition);
}

.privacy-row:hover{
    background:#fcfaf8;
}

.privacy-row:last-child{
    border-bottom:none;
}

/*=====================================
LEFT ICON
======================================*/

.privacy-icon{
    width:90px;
    height:90px;
    min-width:90px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:36px;
    color:var(--primary);
    background:#fff;
    border:1px solid rgba(197,139,71,.18);
    box-shadow:0 8px 25px rgba(0,0,0,.05);
}

/*=====================================
RIGHT CONTENT
======================================*/

.privacy-content{
    flex:1;
}

.privacy-content h2{
    font-family:'Cormorant Garamond',serif;
    font-size:44px;
    font-weight:600;
    color:#162333;
    margin:0 0 28px;
    line-height:1.15;
}

.privacy-content h4{
    font-size:17px;
    color:var(--primary);
    margin:0 0 18px;
    font-weight:600;
}

.privacy-content p{
    color:var(--black);
    font-size:16px;
    line-height:1.9;
    margin-bottom:18px;
}

/*=====================================
TWO COLUMNS
======================================*/

.privacy-columns{
    display:flex;
    gap:60px;
}

.privacy-column{
    flex:1;
}

.privacy-column:last-child{
    border-left:1px solid rgba(0,0,0,.08);
    padding-left:40px;
}

/*=====================================
LISTS
======================================*/

.privacy-content ul{
    margin:0;
    padding:0;
    list-style:none;
}

.privacy-content ul li{
    position:relative;
    padding-left:28px;
    margin-bottom:10px;
    color:var(--black);
    font-size:15px;
    line-height:1.8;
}

.privacy-content ul li::before{
    content:"✓";
    position:absolute;
    left:0;
    top:2px;
    color:var(--primary);
    font-weight:700;
    font-size:15px;
}

/*=====================================
CONTACT SECTION
======================================*/

.privacy-contact{
    display:flex;
    justify-content:space-between;
    gap:20px;
    margin-top:35px;
    flex-wrap:wrap;
}

.privacy-contact-item{
    flex:1;
    min-width:220px;
    display:flex;
    align-items:center;
    gap:14px;
    padding:18px 22px;
    background:#fff;
    border:1px solid rgba(197,139,71,.15);
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
    transition:var(--transition);
}

.privacy-contact-item:hover{
    transform:translateY(-5px);
    border-color:var(--primary);
    box-shadow:0 18px 35px rgba(0,0,0,.08);
}

.privacy-contact-item{
    font-size:24px;
}

.privacy-contact-item span{
    font-size:16px;
    color:var(--black);
    word-break:break-word;
}

/*=====================================
HOVER EFFECTS
======================================*/

.privacy-icon,
.privacy-contact-item,
.privacy-row{
    transition:var(--transition);
}

.privacy-row:hover .privacy-icon{
    background:var(--primary);
    color:#fff;
    transform:rotate(8deg) scale(1.05);
}

.privacy-content h2{
    transition:var(--transition);
}

.privacy-row:hover h2{
    color:var(--primary);
}

/*=====================================
TABLET
======================================*/

@media(max-width:991px){

    .privacy-content-section{
        padding:70px 0;
    }

    .privacy-row{
        gap:30px;
        padding:40px;
    }

    .privacy-icon{
        width:75px;
        height:75px;
        min-width:75px;
        font-size:30px;
    }

    .privacy-content h2{
        font-size:34px;
    }

    .privacy-columns{
        flex-direction:column;
        gap:30px;
    }

    .privacy-column:last-child{
        border-left:none;
        border-top:1px solid rgba(0,0,0,.08);
        padding-left:0;
        padding-top:30px;
    }

    .privacy-contact{
        flex-direction:column;
    }

}

/*=====================================
MOBILE
======================================*/

@media(max-width:767px){

    .privacy-content-section{
        padding:60px 0;
    }

    .privacy-card{
        border-radius:20px;
    }

    .privacy-row{
        flex-direction:column;
        padding:30px 25px;
        gap:25px;
    }

    .privacy-icon{
        width:65px;
        height:65px;
        min-width:65px;
        font-size:26px;
    }

    .privacy-content h2{
        font-size:30px;
        margin-bottom:20px;
    }

    .privacy-content h4{
        font-size:17px;
    }

    .privacy-content p,
    .privacy-content ul li{
        font-size:15px;
        line-height:1.8;
    }

    .privacy-contact{
        margin-top:25px;
    }

    .privacy-contact-item{
        width:100%;
        min-width:100%;
        padding:16px 18px;
    }

}

/*=====================================
SMALL MOBILE
======================================*/

@media(max-width:480px){

    .privacy-row{
        padding:24px 20px;
    }

    .privacy-icon{
        width:58px;
        height:58px;
        min-width:58px;
        font-size:22px;
    }

    .privacy-content h2{
        font-size:26px;
    }

    .privacy-content p,
    .privacy-content ul li{
        font-size:14px;
    }

    .privacy-contact-item{
        flex-direction:column;
        text-align:center;
        gap:10px;
    }

    .privacy-contact-item span{
        font-size:15px;
    }

}

/*=====================================
LARGE DESKTOP
======================================*/

@media(min-width:1400px){

    .privacy-card{
        border-radius:32px;
    }

    .privacy-row{
        padding:60px;
    }


    .privacy-content p{
        font-size:16px;
    }

    .privacy-content ul li{
        font-size:15px;
    }

}



</style>
