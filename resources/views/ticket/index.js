<script>
 user="{{auth()->user()->type}}"
 state="{{$ticket->state}}"
 document.querySelectorAll('.form-select option').forEach(element=>{

     if (element.value<=state){
         element.disabled=true
     }

     if (element.value==state){
         element.selected=true 
     }

 })


if(user=='client'){
 document.querySelector('.form-select').disabled=true
}
 console.log(user)
</script>