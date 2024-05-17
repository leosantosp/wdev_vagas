<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="POST">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input id="titulo" type="text" name="titulo" class="form-control" value="<?=$obVaga->titulo?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="5"><?=$obVaga->descricao?></textarea>
        </div>

        <div class="form-group">
            <label >Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="S" checked> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="N" <?=$obVaga->ativo == 'N' ? 'checked' : '' ?> > Inativo
                    </label>
                </div>
            </div>
            
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>

</main>