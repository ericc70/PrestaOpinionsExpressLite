const token=document.querySelector('input[name="csrf_token"]').value 
const idQuestion=document.querySelector('input[name="id_question"]').value 
const form = document.querySelector('#formExpressOpinion');
const radioButtons = document.querySelectorAll('input[type="radio"]');
const formOpen = document.getElementById('form-open');
const formClose = document.getElementById('form-close');
formClose.style.display = 'none';


radioButtons.forEach((button) => {
  button.addEventListener("change", () => {
    let formData = new FormData();
    formData.append('token', token);
    formData.append('idQuestion', idQuestion);
    formData.append('idReponse', button.value);
 
      fetch(form.getAttribute('action'), {
        method: 'POST',
        body: formData
      
    }) 
    .then(rep => { 
  
      if(rep.status == 200){
        formOpen.style.display = 'none';
        formClose.style.display = 'block';
      }
      if(rep.status == 403){
       
      }
    })
    .catch(err => console.log(err))



  });
});
