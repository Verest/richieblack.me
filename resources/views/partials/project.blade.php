<div class="card">
  <a href={{route('project', $project->slug)}}>
    <img class="card__images" src={{"assets/images/".$project->image->src}} alt={{$project->alt}} />
  </a>
  <p>{!!$project->description!!}</p>
</div>
