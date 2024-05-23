const token=document.querySelector('input[name="csrf_token"]').value // Gestion des interactions (Vanilla ES6)
const idQuestion=document.querySelector('input[name="id_question"]').value // Gestion des interactions (Vanilla ES6)
const form = document.querySelector('#formExpressOpinion');
const radioButtons = document.querySelectorAll('input[type="radio"]');
const formOpen = document.getElementById('form-open');
const formClose = document.getElementById('form-close');
formClose.style.display = 'none';


radioButtons.forEach((button) => {
  button.addEventListener("change", () => {
    // Logique à exécuter lorsque l'utilisateur sélectionne une option
    console.log(`Option sélectionnée:  ${button.value}`);
  

    let formData = new FormData();
    formData.append('token', token);
    formData.append('idQuestion', idQuestion);
    formData.append('idReponse', button.value);
      console.log(formData)
    
      fetch(form.getAttribute('action'), {
        method: 'POST',
        body: formData
      
    }) 
    .then(rep => { 
      console.log(rep)
      if(rep.status == 200){
        
        formOpen.style.display = 'none';
        formClose.style.display = 'block';
        console.log("ee")
      }
      if(rep.status == 403){
        console.log("ee")
      }
    })
    .catch(err => console.log(err))



  });
});
