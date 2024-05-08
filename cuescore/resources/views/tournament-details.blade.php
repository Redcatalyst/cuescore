@include('header')
<div class="container">

    <div class="row">

        <div class="col-sm">
            <div class="card border-0 hexagon1">
                <a href="<?=$tournament['url']?>" target="_blank">
                    <img class="card-img-top" src="<?=$tournament['image_path']?>" alt="">
                </a>
            </div>
        </div>

        <div class="col-sm">
        <div class="card-body border-0">
            <h5 class="card-title"><?=$tournament['discipline']?></h5>
            <p class="card-text"><?=$tournament['name']?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Aanvang: <?=$tournament['starttime']?></li>
            <li class="list-group-item">Tot: <?=$tournament['stoptime']?></li>
        </ul>
        </div>
    </div>

    <?php if($tournament['status'] == 'Finished'): ?>
        <!-- Standings -->
        <div class="row">
            <h2 class="text-center">Dit toernooi is al gespeeld</h2>
        </div>

        <!-- Poules -->
    <?php elseif($tournament['status'] == 'Open'): ?>
        <div class="row">
            <h2 class="text-center">Opgeven voor het toernooi kan bij een van de volgende personen</h2>
            <?php foreach($tournament['contacts'] as $contact): ?>
                <div class="col-sm">
                    <div class="card border-0">
                        <a href="<?=$contact['url']?>" target="_blank">
                            <img class="card-img-top" src="<?=$contact['image']?>" alt="<?=$contact['name']?>">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?=$contact['name']?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="row">
            <h1>Op dit moment word het toernooi gespeeld, kom later terug voor een uitslag.</h1>
        </div>
    <?php endif; ?>


</div>

@include('footer') 