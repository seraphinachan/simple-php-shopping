<!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<style>
  .yellow {
    color: #FFD700;
  }
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light rounded" style="width: 280px;">
  <div class="d-flex flex-column my-auto">
    <span class="fs-4">검색 필터</span>
    <hr>
    <div class="list-group" id="rating_filter">
      <button type="button" class="list-group-item list-group-item-action active" id="all" data-rating="all">
        전체 별점
      </button>
      <button type="button" class="list-group-item list-group-item-action" id="four_star" data-rating="4">
        4점 이상
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star"></i>
      </button>
      <button type="button" class="list-group-item list-group-item-action" id="three_star" data-rating="3">
        3점 이상
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
      </button>
      <button type="button" class="list-group-item list-group-item-action" id="two_star" data-rating="2">
        2점 이상
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
      </button>
      <button type="button" class="list-group-item list-group-item-action" id="one_star" data-rating="1">
        1점 이상
        <i class="bi bi-star-fill yellow"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
      </button>
    </div>
    <hr>
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action active">
        전체 가격
      </a>
      <button type="button" class="list-group-item list-group-item-action">1만원 이상</button>
      <button type="button" class="list-group-item list-group-item-action">5천원 ~ 1만원</button>
      <button type="button" class="list-group-item list-group-item-action">1천원 ~ 5천원</button>
    </div>
  </div>
</div>
