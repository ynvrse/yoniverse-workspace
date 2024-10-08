<x-layouts.app title="home">
    <div x-data="kanban()" class="flex justify-center items-center h-screen gap-4">
        <div class="bg-gray-200 p-4 rounded-lg w-80">
            <h2 class="font-bold mb-4 text-lg">To Do</h2>
            <div x-ref="todo" @drop="onDrop($event, 'todo')" @dragover.prevent @dragenter.prevent
                class="min-h-[200px] bg-gray-100 p-2 rounded">
                <template x-for="item in todo" :key="item.id">
                    <div draggable="true" @dragstart="dragStart($event, item)"
                        class="bg-white p-3 mb-2 rounded-lg shadow-md cursor-move hover:shadow-lg transition-shadow duration-200">
                        <h3 x-text="item.title" class="font-semibold mb-1"></h3>
                        <p x-text="item.description" class="text-sm text-gray-600"></p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Kolom In Progress -->
        <div class="bg-gray-200 p-4 rounded-lg w-80">
            <h2 class="font-bold mb-4 text-lg">In Progress</h2>
            <div x-ref="inProgress" @drop="onDrop($event, 'inProgress')" @dragover.prevent @dragenter.prevent
                class="min-h-[200px] bg-gray-100 p-2 rounded">
                <template x-for="item in inProgress" :key="item.id">
                    <div draggable="true" @dragstart="dragStart($event, item)"
                        class="bg-white p-3 mb-2 rounded-lg shadow-md cursor-move hover:shadow-lg transition-shadow duration-200">
                        <h3 x-text="item.title" class="font-semibold mb-1"></h3>
                        <p x-text="item.description" class="text-sm text-gray-600"></p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Kolom Done -->
        <div class="bg-gray-200 p-4 rounded-lg w-80">
            <h2 class="font-bold mb-4 text-lg">Done</h2>
            <div x-ref="done" @drop="onDrop($event, 'done')" @dragover.prevent @dragenter.prevent
                class="min-h-[200px] bg-gray-100 p-2 rounded">
                <template x-for="item in done" :key="item.id">
                    <div draggable="true" @dragstart="dragStart($event, item)"
                        class="bg-white p-3 mb-2 rounded-lg shadow-md cursor-move hover:shadow-lg transition-shadow duration-200">
                        <h3 x-text="item.title" class="font-semibold mb-1"></h3>
                        <p x-text="item.description" class="text-sm text-gray-600"></p>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
        function kanban() {
            return {
                todo: [{
                        id: 1,
                        title: 'Tugas 1',
                        description: 'Deskripsi tugas 1'
                    },
                    {
                        id: 2,
                        title: 'Tugas 2',
                        description: 'Deskripsi tugas 2'
                    },
                ],
                inProgress: [{
                    id: 3,
                    title: 'Tugas 3',
                    description: 'Deskripsi tugas 3'
                }, ],
                done: [{
                    id: 4,
                    title: 'Tugas 4',
                    description: 'Deskripsi tugas 4'
                }, ],
                draggedItem: null,
                dragStart(event, item) {
                    this.draggedItem = item;
                    event.dataTransfer.effectAllowed = 'move';
                },
                onDrop(event, list) {
                    const sourceList = this[this.findSourceList()];
                    const targetList = this[list];

                    sourceList.splice(sourceList.indexOf(this.draggedItem), 1);
                    targetList.push(this.draggedItem);

                    this.draggedItem = null;
                },
                findSourceList() {
                    return ['todo', 'inProgress', 'done'].find(list =>
                        this[list].includes(this.draggedItem)
                    );
                }
            }
        }
    </script>
</x-layouts.app>
