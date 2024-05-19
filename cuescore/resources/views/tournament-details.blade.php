@include('header')
<div class="container">

    <div class="row hero-detail">

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
        <div class="row tournament-details">
            <h2 class="text-center">Wedstrijdleiding</h2>
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
            <p>
                Je kunt je opgeven door een van de bovenstaande personen te berichten/bellen of anders via ons opgave formulier.
                We zullen je een berichtje sturen als de opgave bevestigd is. 
            </p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="text-left col-6" action="/details" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="cuescoreName">Cuescore naam</label>
                    <input type="text" class="form-control" id="cuescoreName" name="cuescoreName" placeholder="Je voor en achternaam">
                </div>
                <div class="form-group">
                    <label for="cuescoreLink">Cuescore link (optioneel, helpt ons sneller je account te vinden)</label>
                    <input type="url" class="form-control" id="cuescoreLink" name="cuescoreLink" placeholder="https://cuescore.com/player/naam/id">
                </div>
                <div class="form-group">
                    <label for="phonenumber">Mobielnummer</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="0612345678">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox">
                    <label class="form-check-label" for="checkbox">Ik ga akkoord met de voorwaarden. (todo)</label>
                </div>
                <input type="hidden" name="tournament" value="<?=$tournament['tournamentId']?>">
                <button type="submit" class="btn btn-primary">Bevestig opgave</button>
            </form>
        </div>
    <?php else: ?>
        <div class="row">
            <h1>Op dit moment word het toernooi gespeeld, kom later terug voor een uitslag.</h1>
        </div>
    <?php endif; ?>


</div>

@include('footer') 