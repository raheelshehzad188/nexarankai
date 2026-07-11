<style>
:root{
--primary:#c58b47;
--primary-dark:#b47b3b;
--white:#ffffff;
--black:#111111;
--text:#f5f5f5;
--container:1320px;
--transition:.3s ease;
}

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Jost',sans-serif;
overflow-x:hidden;
}

img{
max-width:100%;
display:block;
}

a{
text-decoration:none;
}

ul{
list-style:none;
}

.container{
width:100%;
max-width:1280px;
padding:0 20px;
margin:auto;
}

/* ==========================
HEADER
========================== */

.header{
position:fixed;
top:0;
left:0;
width:100%;
z-index:9999;
transition:.3s ease;
background:transparent;
}

.header.scrolled{
background:#0D1823;
box-shadow:0 8px 30px rgba(0,0,0,.18);
}

.navbar{
display:flex;
align-items:center;
justify-content:space-between;
gap:30px;
flex-direction: row;
}

.logo img{
max-width:160px;
}

.nav-menu ul{
display:flex;
align-items:center;
gap:35px;
}

.nav-menu a{
font-size:14px;
font-weight:500;
color:#fff;
transition:.3s;
}

.nav-menu a:hover,
.nav-menu a.active{
color: var(--primary);
border-bottom: 1px solid var(--primary);
padding: 10px 0px !important;
}

.header-btn{
display:flex;
align-items:center;
}

.btn-primary{
background: var(--primary);
color: #fff;
padding: 10px 26px;
border-radius: 4px;
font-size: 14px;
font-weight: 500;
transition: .3s;
}

.btn-primary:hover{
background:var(--primary-dark);
}

.menu-toggle{
display:none;
background:none;
border:none;
color:#fff;
font-size:32px;
cursor:pointer;
z-index:1002;
transition:.3s;
}

.menu-overlay{
position:fixed;
inset:0;
background:rgba(0,0,0,.55);
opacity:0;
visibility:hidden;
transition:.3s;
z-index:1000;
}

.menu-overlay.active{
opacity:1;
visibility:visible;
}

@media(max-width:768px){
.header-btn{
display:none;
}
.menu-toggle{
display:block;
}
.nav-menu{
position:fixed;
top:0;
right:-100%;
width:400px;
max-width:85%;
height:70vh;
background:#0D1823;
padding:90px 35px 40px;
transition:.35s ease;
box-shadow:-10px 0 40px rgba(0,0,0,.35);
z-index:1001;
overflow-y:auto;
border: 1px solid #C58B47;
}
.nav-menu.active{
right:0;
}
.nav-menu ul{
width: 65%;
display:flex;
flex-direction:column;
gap:8px;
padding:0;
margin:0;
list-style:none;
}
.nav-menu ul li{
width:100%;
}
.nav-menu ul li a{
display:block;
width:100%;
padding:15px 18px;
color:#fff;
text-decoration:none;
font-size:17px;
border-radius:10px;
transition:.3s;
}
.nav-menu ul li a:hover,
.nav-menu ul li a.active{
background:var(--primary);
padding: 10px 20px !important;
color:#fff;
}
}

@media(max-width:991px){
.nav-menu ul{
gap:18px;
}
}

/* ==========================
FOOTER
========================== */

.new-footer{
background:#0D1823;
color:#fff;
padding:70px 0 0;
margin-top:0;
}

.new-footer-grid{
display:grid;
grid-template-columns:1.2fr 1fr 1fr;
gap:40px;
padding-bottom:50px;
border-bottom:1px solid rgba(197,139,71,.2);
}

.new-footer-brand img{
max-width:170px;
margin-bottom:18px;
}

.new-footer-brand p{
font-size:15px;
line-height:1.8;
color:rgba(255,255,255,.75);
max-width:320px;
}

.new-footer-heading{
font-size:16px;
font-weight:600;
color:var(--primary);
margin-bottom:18px;
letter-spacing:.5px;
}

.new-footer-links ul{
display:flex;
flex-direction:column;
gap:12px;
}

.new-footer-links a{
color:rgba(255,255,255,.85);
font-size:15px;
transition:.3s;
}

.new-footer-links a:hover{
color:var(--primary);
}

.new-footer-contact-item{
display:flex;
align-items:flex-start;
gap:12px;
margin-bottom:16px;
}

.new-footer-contact-item span.icon{
width:36px;
height:36px;
border-radius:50%;
background:rgba(197,139,71,.15);
display:flex;
align-items:center;
justify-content:center;
flex-shrink:0;
}

.new-footer-contact-item h4{
font-size:16px;
font-weight:600;
margin-bottom:4px;
}

.new-footer-contact-item p{
font-size:14px;
color:rgba(255,255,255,.7);
}

.new-footer-bottom{
padding:22px 0;
text-align:center;
font-size:14px;
color:rgba(255,255,255,.6);
}

@media(max-width:991px){
.new-footer-grid{
grid-template-columns:1fr 1fr;
}
}

@media(max-width:767px){
.new-footer{
padding-top:50px;
}
.new-footer-grid{
grid-template-columns:1fr;
gap:30px;
}
}
</style>
