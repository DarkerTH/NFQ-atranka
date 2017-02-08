<div class="row justify-content-md-center" style="padding: 1rem 0 1rem 0">
    <form class="col-lg-8" id="searchForm" method="get" action="{{ url('/') }}">
        <div class="input-group input-group-lg">
            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-book" aria-hidden="true"></i></span>
            <input type="text" name="query" class="form-control" placeholder="Pavadinimas / metai / autorius / žanras" required>
            <span class="input-group-btn">
                <button class="btn btn-success" type="button" style="cursor: pointer;" onclick="getElementById('searchForm').submit(); return false;">Ieškoti</button>
            </span>
        </div>
    </form>
</div>