<template>
  <div class="row">
    <div class="col-md-9">
         <div class="row">
      <div style="border:1px solid black;" class="media simple-post col-md-6" v-for="post in posts" :key="post.id">
        <img
          class="align-self-center mr-3"
          :src="'img/' + post.image"
          alt="Generic placeholder image"
        />
        <div class="media-body">
          <h4 class="mt-0">
            <!-- <a :href="'/post/'+post.slug">title</a> -->
            <router-link :to="'/post/' + post.slug">{{
              post.title
            }}</router-link>
          </h4>
          {{ post.body.substr(0.15) }}
          <ul class="list-inline list-unstyled d-flex post-info">
            <li>
              <span
                ><i class="fa fa-user"></i>
                <strong class="text-primary">{{ post.user.name }}</strong>
              </span>
            </li>
            <li>|</li>
            <li>
              <span><i class="fa fa-calendar"></i> {{ post.added_at }} </span>
            </li>
            <li>|</li>
            <span
              ><i class="fa fa-comment"></i>
              {{ post.comments_count }} comments</span
            >
          </ul>
        </div>
      </div>
         </div>
    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-3">
      <categories></categories>
     </div>
  </div>
</template>

<script>
import Categories from "./Categories.vue";
export default {
  data() {
    return {
      posts: [],
    };
  },
   components: {
    Categories,
  },
  mounted() {
    console.log("Component mounted.");
    this.getPosts();
  },
  methods: {
    getPosts() {
      axios.get("http://localhost:8000/api/posts")
        .then((res) => {
          this.posts = res.data;
        })
        .then((err) => console.log(err));
    },
  },
};
</script>
