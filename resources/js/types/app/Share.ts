import type File from '@/types/app/File';
export interface Share {
    id: number;
    user_id: number;
    title: string;
    description: string;
    files: File[];
}
