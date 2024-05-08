@include('header')

<p>Using the <a href="https://api.cuescore.com/" target="_blank">Cuescore API</a> to retrieve information.</p>
<?php foreach ($items as $item): ?>
    <p><a href="/details/id={{ $item->id }}" target="_blank">{{ $item->name }} {{ $item->date }}</p>
<?php endforeach ?>

@include('footer') 
