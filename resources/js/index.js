let rects = document.querySelectorAll('rect')
console.log(rects);
rects.forEach((e)=>{
    e.addEventListener('click', (ev)=>{
        console.log(e.getAttribute('id'));
    })
})
