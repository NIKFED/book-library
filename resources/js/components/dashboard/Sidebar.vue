<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="../../index3.html" class="brand-link">
      <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <font-awesome-icon icon="fa-solid fa-search" />
            </button>
          </div>
        </div>
        <div class="sidebar-search-results">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <div class="search-title">
                <strong class="text-light"></strong>N
                <strong class="text-light"></strong>o
                <strong class="text-light"></strong>
                <strong class="text-light"></strong>e
                <strong class="text-light"></strong>l
                <strong class="text-light"></strong>e
                <strong class="text-light"></strong>m
                <strong class="text-light"></strong>e
                <strong class="text-light"></strong>n
                <strong class="text-light"></strong>t
                <strong class="text-light"></strong>
                <strong class="text-light"></strong>f
                <strong class="text-light"></strong>o
                <strong class="text-light"></strong>u
                <strong class="text-light"></strong>n
                <strong class="text-light"></strong>d
                <strong class="text-light"></strong>!
                <strong class="text-light"></strong>
              </div>
              <div class="search-path"></div>
            </a>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/#/book-list" class="nav-link">
              <font-awesome-icon icon="fa-solid fa-book-open" class="nav-icon" />
              <p>
                Books
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link">
              <font-awesome-icon icon="fa-solid fa-table" class="nav-icon" />
              <p>
                Dictionaries
                <font-awesome-icon icon="fas fa-angle-left" class="right" />
              </p>
            </a>
            <ul class="nav nav-treeview">
              <b-nav-item to="/dictionary-list/statuses">
                <font-awesome-icon icon="far fa-circle" class="nav-icon" />
                <p>Statuses</p>
              </b-nav-item>
              <b-nav-item to="/dictionary-list/categories">
                <font-awesome-icon icon="far fa-circle" class="nav-icon" />
                <p>Categories</p>
              </b-nav-item>
              <b-nav-item to="/dictionary-list/authors">
                <font-awesome-icon icon="far fa-circle" class="nav-icon" />
                <p>Authors</p>
              </b-nav-item>
            </ul>
          </li>
<!--          <li class="nav-item">-->
<!--            <a href="#" class="nav-link">-->
<!--              <font-awesome-icon icon="far fa-envelope" class="nav-icon" />-->
<!--              <p>-->
<!--                Mailbox-->
<!--                <font-awesome-icon icon="fas fa-angle-left" class="right" />-->
<!--              </p>-->
<!--            </a>-->
<!--            <ul class="nav nav-treeview">-->
<!--              <li class="nav-item">-->
<!--                <a class="nav-link">-->
<!--                  <font-awesome-icon icon="far fa-circle" class="nav-icon" />-->
<!--                  <p>Inbox</p>-->
<!--                </a>-->
<!--              </li>-->
<!--              <li class="nav-item">-->
<!--                <a class="nav-link">-->
<!--                  <font-awesome-icon icon="far fa-circle" class="nav-icon" />-->
<!--                  <p>Compose</p>-->
<!--                </a>-->
<!--              </li>-->
<!--              <li class="nav-item">-->
<!--                <a class="nav-link">-->
<!--                  <font-awesome-icon icon="far fa-circle" class="nav-icon" />-->
<!--                  <p>Read</p>-->
<!--                </a>-->
<!--              </li>-->
<!--            </ul>-->
<!--          </li>-->
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
export default {
  name: "Sidebar",
}
</script>

<style scoped>

</style>