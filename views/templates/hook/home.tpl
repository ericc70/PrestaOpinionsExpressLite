<section id="container-expressopinion" class="expressopinion-background01">
 <div id="form-open" >
<form id="formExpressOpinion" action="{$form_action}" method="post">
    <p class="ec-form-opinion-titile ">{$question}</p>

    <form action="{$form_action}" method="post">
      <input type="hidden" name="csrf_token" value="{$csrf_token}">
      <input type="hidden" name="id_question" value="1">
      {* <p>{$reponses|@var_dump}</p>  *}


      {if $reponses}
        {foreach $reponses as $reponse}
          <label class="radio-label expressopinion-background01">
            <input type="radio" name="demo" value="{$reponse->getId()}" style="display: none;">
            <span class="custom-button">{$reponse->getContent()}</span>
          </label>
        {/foreach}
      {/if}
    </form>

    Enquete anonymiser !
    </div>
    <div id="form-close">
    <p>
    Merci pour votre participoation
    </p>
    </div>
</section>