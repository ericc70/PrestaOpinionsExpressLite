<section id="container-expressopinion" class="expressopinion-background01 express-flex">
  <div id="form-img" class="col-e-12 col-e-md-3 m-auto">
  <img class="rotating-image m-auto" src="/modules/expressopinionlite//views/assets/img/discuss.png" alt="logo disuss" />
  </div>
  <div id="form-body" class="col-e-12 col-e-md-9">
    <div id="form-open">
      <form id="formExpressOpinion" action="{$form_action}" method="post">
        <div class="row">
        <p class="ec-form-opinion-titile col-e-12">{$question}</p>
</div>
<div class="row">
<div class="col-e-12 expressopinion-form">
        <form action="{$form_action}" method="post" >
          <input type="hidden" name="csrf_token" value="{$csrf_token}">
          <input type="hidden" name="id_question" value="1">

          {if $reponses}
            {foreach $reponses as $reponse}
              <label class="radio-label expressopinion-background01">
                <input type="radio" name="demo" value="{$reponse->getId()}" style="display: none;">
                <span class="custom-button custom-button-color">{$reponse->getContent()}</span>
              </label>
            {/foreach}
          {/if}
        </form>
</div>
</div>
        <div class="expressopinion-sub-title"> Enquete anonymiser !</div>
    </div>


    <div id="form-close">
      <p>
        Merci pour votre participoation
      </p>
    </div>
  </div>
</section>