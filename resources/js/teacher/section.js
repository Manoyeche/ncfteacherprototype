
if (document.querySelector("#teacherSection")) {
    new Vue({
        el: '#teacherSection',
        data: {
            student: {
                params: {
                    section_id: 0,
                },
                datas: []
            },
        },
        mounted() {
            this.student.params.section_id = this.$refs.section_id.value;

            this.getStudents();
        },
        methods: {
            getStudents: function() {
                axios.post("/teacher/section/get-students", this.student.params).then((res) => {
                    if (res.data.status == 1) {
                        this.student.datas = res.data.datas;
                    }
                }).then(() => { 
                });
            },
            searchStudent: function() {

            },
            addStudent: function(student) {
                
            }
        }
    })
}