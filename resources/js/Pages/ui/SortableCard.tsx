import React from 'react';
import { useSortable } from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';

export interface Project {
    id: string;
    name: string;
    description: string | null;
    priority: 'low' | 'medium' | 'high';
    status: 'draft' | 'in_progress' | 'on_review' | 'completed';
    due_date: string | null;
}

interface Props {
    project: Project;
    isDragging?: boolean;
}

export default function SortableCard({ project, isDragging }: Props) {
    const { attributes, listeners, setNodeRef, transform, transition } = useSortable({ id: project.id });
    
    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
        opacity: isDragging ? 0.5 : 1,
    };

    return (
        <div
            ref={setNodeRef}
            style={style}
            {...attributes}
            {...listeners}
            className="p-4 mb-2 bg-white rounded shadow cursor-move"
        >
            <h3 className="font-bold">{project.name}</h3>
            {project.description && <p className="text-sm text-gray-600">{project.description}</p>}
            <div className="mt-2 flex justify-between items-center">
                <span className={`text-xs px-2 py-1 rounded ${getPriorityColor(project.priority)}`}>
                    {project.priority}
                </span>
                {project.due_date && (
                    <span className="text-xs text-gray-500">
                        Due: {new Date(project.due_date).toLocaleDateString()}
                    </span>
                )}
            </div>
        </div>
    );
}

function getPriorityColor(priority: string) {
    switch (priority) {
        case 'low':
            return 'bg-green-200 text-green-800';
        case 'medium':
            return 'bg-yellow-200 text-yellow-800';
        case 'high':
            return 'bg-red-200 text-red-800';
        default:
            return 'bg-gray-200 text-gray-800';
    }
}