import React from 'react';
import { useDroppable } from '@dnd-kit/core';

interface Props {
    id: string;
    title: string;
    children: React.ReactNode;
}

export default function DroppableColumn({ id, title, children }: Props) {
    const { setNodeRef } = useDroppable({ id });

    return (
        <div ref={setNodeRef} className="flex-1 p-4 bg-gray-100 rounded-lg">
            <h3 className="mb-4 text-lg font-semibold capitalize">{title.replace(/([A-Z])/g, ' $1').trim()}</h3>
            <div className="min-h-[100px]">
                {children}
            </div>
        </div>
    );
}