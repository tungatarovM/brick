<script>
import { mapState } from 'vuex';

export default {
  name: "State",
  computed: {
    ...mapState('auth', {
      auth: state => state,
    }),
  }
}
</script>
