
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

document
.getElementById("navLinks")
.classList.toggle("active");

}



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



document.querySelectorAll('.dropdown-toggle').forEach(btn=>{
    btn.addEventListener('click',function(){
        this.parentElement.classList.toggle('active');
    });
});
