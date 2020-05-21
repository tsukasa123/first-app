<nav class="navbar navbar-light">
    <form class="form-inline" method="GET" action="{{ route('search.results') }}">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text bg-secondary text-white" id="basic-addon1">
            <i class="fas fa-search"></i>
          </span>
        </div>
        <input type="text" class="form-control" name="query" placeholder="Search..." aria-label="Username" aria-describedby="basic-addon1" style="box-shadow: none;">
      </div>
    </form>
</nav>