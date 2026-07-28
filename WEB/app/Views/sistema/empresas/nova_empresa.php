<?= view('sistema/layout/header') ?>

    <div class="page-title">
    <h1>Cadastro de Administradores </h1>
    <p>Cadastre os administradores permitidos em seu sistema.</p>
  </div> 

  
<div class="container">
    <h1>Nova Empresa</h1>
    <form action="<?= base_url('empresas/inserir') ?>" method="post">

        <label>CNPJ</label>
        <input type="text" name="EMP_CNPJ" id="cnpjEmpresas" maxlength="18" placeholder="00.000.000/0000-00" required>

        <label>Nome</label>
        <input type="text" name="EMP_NOME" id="nomeEmpresas" required>

        <label>Rua</label>
        <input type="text" name="EMP_RUA" required>

        <label>Número</label>
        <input type="text" name="EMP_NUMERO" required>

        <label>Cidade</label>
        <input type="text" name="EMP_CIDADE" id="cidadeEmpresas" required>

        <label>Status</label>
        <select name="EMP_STATUS" id="statusEmpresas" required>
            <option value="">Selecione</option>
            <option value="Ativa">Ativa</option>
            <option value="Inativa">Inativa</option>
        </select>

        <div class="botoes">
            <button type="submit" class="btn btn-salvar">Salvar</button>
            <a href="<?= base_url('empresas') ?>" class="btn btn-voltar">Voltar</a>
        </div>

    </form>
</div>

<script>
    const cnpjInput = document.getElementById("cnpjEmpresas");

    cnpjInput.addEventListener("input", function(){
        let cnpj = cnpjInput.value.replace(/\D/g,"");

        if(cnpj.length > 2 && cnpj.length <= 5){
            cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2);
        }
        else if(cnpj.length > 5 && cnpj.length <= 8){
            cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5);
        }
        else if(cnpj.length > 8 && cnpj.length <= 12){
            cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5,8) + "/" + cnpj.slice(8);
        }
        else if(cnpj.length > 12){
            cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5,8) + "/" + cnpj.slice(8,12) + "-" + cnpj.slice(12,14);
        }

        cnpjInput.value = cnpj;
    });
</script>

<?= view('sistema/layout/footer') ?>