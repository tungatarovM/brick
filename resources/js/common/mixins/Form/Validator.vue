<script>
import validateFields from '../../../core/validator';

// RULE FORMAT
// 'required|string|number|object|min:6|max:16|type:string',

export default {
  name: "Validator",
  methods: {
    validate(rules) {
      const fields = this.getFields(rules);

      return validateFields(fields, rules);
    },
    getFields(rules) {
      const fieldNames = Object.keys(rules);
      return fieldNames.reduce((fields, fieldName) => {
        return [
          ...fields,
          {
            name: fieldName,
            value: this[fieldName],
          }
        ]
      }, []);
    }
  }
}
</script>
