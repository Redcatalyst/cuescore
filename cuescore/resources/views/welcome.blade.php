@include('header')

<div class="container">
    <div class="row">
        <h2 class="text-center">Aankomende toernooien</h2>
        <?php foreach($tournaments as $tournament): ?>
            <?php if($tournament['status'] == 'Open'): ?>
                <div class="col-m">
                    <div class="card border-0">
                        <img class="card-img-top" src="..." alt="">
                        <div class="card-body">
                            <a href="/details/<?=$tournament['id']?>" target="_blank">
                                <h5 class="card-title text-center"><?=$tournament['name']?></h5>
                            </a>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Aanvang: <?=$tournament['starttime']?></li>
                                <li class="list-group-item">Tot: <?=$tournament['stoptime']?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

    <div class="row">
        <h2 class="text-center">Gespeelde toernooien</h2>
        <?php foreach($tournaments as $tournament): ?>
            <?php if($tournament['status'] == 'Finished'): ?>
                <div class="col-m">
                    <div class="card border-0">
                        <img class="card-img-top" src="..." alt="">
                        <div class="card-body">
                            <a href="/details/<?=$tournament['id']?>" target="_blank">
                                <h5 class="card-title text-center"><?=$tournament['name']?></h5>
                            </a>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Aanvang: <?=$tournament['starttime']?></li>
                                <li class="list-group-item">Tot: <?=$tournament['stoptime']?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
    <small>Using the <a href="https://api.cuescore.com/" target="_blank">Cuescore API</a> to retrieve information.</small>
</div>

@include('footer') 
