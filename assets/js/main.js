
document.querySelectorAll('.slider')
.forEach(slider=>{


slider.addEventListener(
'input',
function(){


let value=this.value;


let parent=this.parentElement;


parent.querySelector(
'.after-container'
)
.style.width=value+"%";



parent.querySelector(
'.slider-line'
)
.style.left=value+"%";



});


});




const galleryImages = [

"1.jpeg",
"2.jpeg",
"3.jpeg",
"4.jpeg",
"5.jpeg",
"6.jpeg",
"7.jpeg",
"8.jpeg",
"9.jpeg"

];


let current = 4;



function updateCases(){


const total = galleryImages.length;



let center =
current;



let left1 =
(center-2+total)%total;


let left2 =
(center-1+total)%total;



let right1 =
(center+1)%total;


let right2 =
(center+2)%total;




// Center image

document
.getElementById("mainCaseImage")
.src =
"assets/images/gallery/"
+
galleryImages[center];




// Left images

let left =
document.querySelectorAll(
"#leftImages img"
);



left[0].src =
"assets/images/gallery/"
+
galleryImages[left1];


left[1].src =
"assets/images/gallery/"
+
galleryImages[left2];





// Right images


let right =
document.querySelectorAll(
"#rightImages img"
);



right[0].src =
"assets/images/gallery/"
+
galleryImages[right1];


right[1].src =
"assets/images/gallery/"
+
galleryImages[right2];



}





function nextCase(){


current++;


if(current >= galleryImages.length){

current=0;

}


updateCases();


}



updateCases();



let autoPlay =
setInterval(
nextCase,
3000
);




document
.querySelector(".next-case")
.addEventListener(
"click",
()=>{


clearInterval(autoPlay);


nextCase();



autoPlay =
setInterval(
nextCase,
3000
);


});





document
.querySelector(".prev-case")
.addEventListener(
"click",
()=>{


clearInterval(autoPlay);


current--;


if(current < 0){

current =
galleryImages.length-1;

}



updateCases();



autoPlay =
setInterval(
nextCase,
3000
);


});


function toggleMenu(){

const navLinks = document.getElementById("navLinks");

if(navLinks){
navLinks.classList.toggle("active");
}

}


/* Close the mobile navigation after selecting Location or Contact. */
document.querySelectorAll('.mobile-menu-close-link').forEach(link => {
    link.addEventListener('click', function(){
        if(!window.matchMedia('(max-width: 900px)').matches){
            return;
        }

        const navLinks = document.getElementById('navLinks');
        if(navLinks){
            navLinks.classList.remove('active');
        }

        document.querySelectorAll('.nav-dropdown.active').forEach(dropdown => {
            dropdown.classList.remove('active');
            const toggle = dropdown.querySelector('.dropdown-toggle');
            if(toggle){
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    });
});



/* ==============================
   Scroll Reveal Animation
============================== */

const revealElements = document.querySelectorAll(
    '.hero-image, .about-image, .service-card, .about-tags span, .contact-btn'
);

const revealObserver = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add('show');
            revealObserver.unobserve(entry.target);
        }
    });
},{
    threshold:0.15
});


revealElements.forEach(el=>{
    revealObserver.observe(el);
});



/* Services dropdown:
   - Desktop: opens with hover/focus (CSS).
   - Mobile: opens with a tap because touch screens have no hover. */
document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    toggle.addEventListener('click', function(event){
        if(!window.matchMedia('(max-width: 900px)').matches){
            return;
        }

        event.preventDefault();

        const dropdown = this.closest('.nav-dropdown');
        const willOpen = !dropdown.classList.contains('active');

        document.querySelectorAll('.nav-dropdown.active').forEach(item => {
            if(item !== dropdown){
                item.classList.remove('active');
                const otherToggle = item.querySelector('.dropdown-toggle');
                if(otherToggle){
                    otherToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });

        dropdown.classList.toggle('active', willOpen);
        this.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });
});

document.addEventListener('click', function(event){
    if(!window.matchMedia('(max-width: 900px)').matches){
        return;
    }

    if(!event.target.closest('.nav-dropdown')){
        document.querySelectorAll('.nav-dropdown.active').forEach(dropdown => {
            dropdown.classList.remove('active');
            const toggle = dropdown.querySelector('.dropdown-toggle');
            if(toggle){
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});

window.addEventListener('resize', function(){
    if(window.matchMedia('(min-width: 901px)').matches){
        document.querySelectorAll('.nav-dropdown.active').forEach(dropdown => {
            dropdown.classList.remove('active');
            const toggle = dropdown.querySelector('.dropdown-toggle');
            if(toggle){
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});
