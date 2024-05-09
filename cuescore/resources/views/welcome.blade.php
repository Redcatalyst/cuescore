@include('header')

<div class="container">
    <div class="row my-4">
        <h2>Aankomende toernooien</h2>
        <?php foreach($tournaments as $tournament): ?>
            <?php if($tournament['status'] == 'Open'): ?>
                <div class="col-md-6">
                    <div class="card flex-md-row box-shadow h-md250 my-2">
                        <div class="card-body d-flex flex-column align-items-start">
                            <a href="/details/<?=$tournament['id']?>" target="_blank" class="text-dark text-decoration-none">
                                <h5 class="card-title"><?=$tournament['name']?></h5>
                            </a>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Aanvang: <?=$tournament['starttime']?></li>
                                <li class="list-group-item">Tot: <?=$tournament['stoptime']?></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <img class="card-img-top" src="<?=$tournament['image']?>" alt="" class="object-fit-md-cover" style="height: 195px;">
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

    <div class="row my-4">
        <h2>Gespeelde toernooien</h2>
        <?php foreach($tournaments as $tournament): ?>
            <?php if($tournament['status'] == 'Finished'): ?>
                <div class="col-md-6">
                    <a href="/details/<?=$tournament['id']?>" target="_blank" class="text-dark text-decoration-none">
                        <div class="card flex-md-row mb4 box-shadow h-md250 my-2">
                            <div class="card-body d-flex flex-column align-items-start">
                                <h5 class="card-title"><?=$tournament['name']?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Aanvang: <?=$tournament['starttime']?></li>
                                    <li class="list-group-item">Tot: <?=$tournament['stoptime']?></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <img class="card-img-top" src="<?=$tournament['image']?>" alt="" class="object-fit-md-cover" style="height: 200px;">
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
    <small>Using the <a href="https://api.cuescore.com/" target="_blank">Cuescore API</a> to retrieve information.</small>
</div>

@include('footer') 
