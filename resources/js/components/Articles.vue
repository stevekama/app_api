<template>
  <div>
    <h2>Articles</h2>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li
          v-bind:class="[{ disabled: !pagination.prev_page_url }]"
          class="page-item"
        >
          <a
            class="page-link"
            href="#"
            @click="fetchArticles(pagination.prev_page_url)"
            aria-label="Previous"
          >
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>

        <li class="page-item disabled">
          <a class="page-link text-dark" href="#">
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
          </a>
        </li>

        <li
          v-bind:class="[{ disabled: !pagination.next_page_url }]"
          class="page-item"
        >
          <a
            class="page-link"
            href="#"
            @click="fetchArticles(pagination.next_page_url)"
            aria-label="Next"
          >
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    <div
      class="card card-body mb-2"
      v-for="article in articles"
      v-bind:key="article.id"
    >
      <h3>{{ article.title }}</h3>
      <p>{{ article.body }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: "",
        title: "",
        body: "",
      },
      article_id: "",
      pagination: {},
      edit: false,
    };
  },

  created() {
    this.fetchArticles();
  },

  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || "/api/articles";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.articles = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },

    makePagination(meta, links) {
      var pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };

      this.pagination = pagination;
    },
  },
};
</script>
