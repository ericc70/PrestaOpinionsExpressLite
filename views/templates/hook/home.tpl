
<section id="container-expressopinion" class="expressopinion-background01">
    <form id="formExpressOpinion" action="{$form_action}" method="post">
 <p class="ec-form-opinion-titile " >{$question}</p>

 
  
  

    
    <form action="{$form_action}" method="post">
    <input type="hidden" name="csrf_token" value="{$csrf_token}"> 
   <input type="hidden" name="id_question" value="1" >
    {* <p>{$reponses}</p> *}

    <label class="radio-label expressopinion-background01">
    <input type="radio" name="demo" value="1" class="radio-button">
    <span class="custom-button">Option 1</span>
  </label>

  
  <label class="radio-label expressopinion-background01">
    <input type="radio" name="demo" value="2" class="radio-button">
    <span class="custom-button">Option 2</span>
  </label>

    <label class="radio-label expressopinion-background01">
    <input type="radio" name="demo" value="3" style="display: none;">
    <span class="custom-button">Option 3</span>
  </label>

</form>


   Enquete anonymiser ! 
  </section>
