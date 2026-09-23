import type FileInfo from '@/types/app/FileInfo';
export interface Share {
    id: number;
    user_id: number;
    title: string;
    description: string;
    files: FileInfo[];
}
