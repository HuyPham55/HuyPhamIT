import {TagType} from "@/pages/post-detail/PostDetail";
import {PaginationType} from "@/components/paginations/Pagination";

declare type PostItem = {
    id: number;
    hash: string;
    title: string;
    short_description: string;
    publish_date: string;
    author?: Author;
    tags?: Array<TagType>;
    view_count?: number | null;
}

declare type PostList = {
    data: Array<PostItem>;
    loading: Boolean;
    meta?: PaginationType;
    orderBy: string;
    order: string;
}

declare type Author = {
    id: string;
    name: string;
    profile_picture: string;
    description: string;
}

export {PostItem, PostList, Author}
