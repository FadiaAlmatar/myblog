<template>
  <!-- Categories Widget -->
  <div class="card text-black bg-warning my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0" v-if="categories">
            <li v-for="(category,index) in categories" :key="index">
              <!-- <a href="#">{{category.name}}</a> -->
              <router-link :to="'category/'+category.slug+'/posts'">{{category.name}}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: '',
    };
  },
  created() {
    this.getCategories();
  },
  methods: {
    getCategories() {
      axios
        .get("http://localhost:8000/api/categories")
        .then((res) => {
          // console.log('categories',res)
          this.categories = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
