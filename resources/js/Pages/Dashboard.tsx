import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { DndContext, DragOverlay, closestCorners, PointerSensor, useSensor, useSensors } from '@dnd-kit/core';
import { SortableContext, verticalListSortingStrategy } from '@dnd-kit/sortable';
import React, { useState } from 'react';
import { createPortal } from 'react-dom';
import SortableCard from './ui/SortableCard';
import DroppableColumn from './ui/DroppableColumn';

interface Project {
    id: string;
    name: string;
    description: string | null;
    priority: 'low' | 'medium' | 'high';
    status: 'draft' | 'in_progress' | 'on_review' | 'completed';
    due_date: string | null;
}

const statusColumns = ['draft', 'in_progress', 'on_review', 'completed'];

export default function Dashboard() {
    const [projects, setProjects] = useState<Project[]>([
        { id: '1', name: 'Proyek 1', description: 'Deskripsi proyek 1', priority: 'low', status: 'draft', due_date: '2023-12-31' },
        { id: '2', name: 'Proyek 2', description: 'Deskripsi proyek 2', priority: 'high', status: 'in_progress', due_date: null },
        { id: '3', name: 'Proyek 3', description: null, priority: 'low', status: 'completed', due_date: '2023-11-30' },
    ]);
    const [activeId, setActiveId] = useState<string | null>(null);

    const sensors = useSensors(useSensor(PointerSensor));

    function handleDragStart(event: any) {
        const { active } = event;
        setActiveId(active.id);
    }

    function handleDragOver(event: any) {
        const { active, over } = event;
        if (!over) return;

        const activeProject = projects.find(project => project.id === active.id);
        const overId = over.id;

        if (!activeProject) return;

        setProjects(projects => {
            const oldIndex = projects.findIndex(project => project.id === active.id);
            const newStatus = overId.toString().includes('column-') ? overId.toString().split('-')[1] : activeProject.status;

            const newProjects = [...projects];
            newProjects[oldIndex] = { ...activeProject, status: newStatus as 'draft' | 'in_progress' | 'on_review' | 'completed' };

            return newProjects;
        });
    }

    function handleDragEnd(event: any) {
        const { active, over } = event;

        if (!over) return;

        if (active.id !== over.id) {
            setProjects(projects => {
                const oldIndex = projects.findIndex(project => project.id === active.id);
                const newIndex = projects.findIndex(project => project.id === over.id);

                return arrayMove(projects, oldIndex, newIndex);
            });
        }

        setActiveId(null);
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Kanban Proyek
                </h2>
            }
        >
            <Head title="Kanban Proyek" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <DndContext
                        sensors={sensors}
                        collisionDetection={closestCorners}
                        onDragStart={handleDragStart}
                        onDragOver={handleDragOver}
                        onDragEnd={handleDragEnd}
                    >
                        <div className="flex space-x-4">
                            {statusColumns.map(status => (
                                <DroppableColumn key={status} id={`column-${status}`} title={status}>
                                    <SortableContext items={projects.filter(project => project.status === status)} strategy={verticalListSortingStrategy}>
                                        {projects.filter(project => project.status === status).map(project => (
                                            <SortableCard key={project.id} project={project} />
                                        ))}
                                    </SortableContext>
                                </DroppableColumn>
                            ))}
                        </div>
                        {createPortal(
                            <DragOverlay>
                                {activeId ? <SortableCard project={projects.find(project => project.id === activeId)!} isDragging /> : null}
                            </DragOverlay>,
                            document.body
                        )}
                    </DndContext>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

function arrayMove<T>(array: T[], from: number, to: number): T[] {
    const newArray = array.slice();
    newArray.splice(to < 0 ? newArray.length + to : to, 0, newArray.splice(from, 1)[0]);
    return newArray;
}