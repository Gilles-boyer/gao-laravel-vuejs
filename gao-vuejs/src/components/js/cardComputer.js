import deleteComputer from "../modal/deleteComputer"
import deleteAttribution from "../modal/deleteAttribution"
import addAttributionWithAutocomplete from "../modal/addAttributionWithAutocomplete"

export default {
    name: 'cardComputer',
    components: {
        deleteComputer,
        deleteAttribution,
        addAttributionWithAutocomplete,
    },
    props: {
        computer: {
            type: Object,
            default: () => [{ id: null, name: null }],
        },
        indexPC: {
            type: Number,
            required: true
        }
    },
    methods: {
        attribution() {
            var data = []
            for (let index = 8; index <= 18; index++) {
                var attribution = {
                    id: null,
                    time: index,
                    client: {
                        id: null,
                        nickName: null,
                    }
                }

                if (this.computer.attributions.length > 0) {
                    for (let i = 0; i < this.computer.attributions.length; i++) {
                        if (attribution.time == this.computer.attributions[i].time) {
                            this.computer.attributions[i].time = this.computer.attributions[i].time
                            attribution = this.computer.attributions[i]
                        }
                    }
                }
                data.push(attribution)
            }

            this.computer.attributions = data;

        }
    },
    mounted() {
        this.attribution()
    },
    watch: {
        computer: function() {
            this.attribution()
        }
    },
}